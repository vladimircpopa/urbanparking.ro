<?php

namespace Urbanparking\UserBundle\Controller;

use AppBundle\Entity\ParkingSlot;
use AppBundle\Entity\Penalty;
use AppBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $session = new Session();

        $messages = $session->getFlashBag()->get('error', array());

        return $this->render('UserBundle:Default:login.html.twig', array(
            'messages' => $messages
        ));
    }

    /**
     * @Route("/login")
     * @Method({"POST"})
     */
    public function loginAction(Request $request)
    {
        $session = new Session();

        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->findOneByEmail($email);

        if ($user && $password === $user->getPassword()) {
            $session->set('user_id', $user->getId());
            return $this->redirectToRoute('homepage');
        }

        $session->getFlashBag()->add('error', 'Invalid email or password!');
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        $session = new Session();
        $session->remove('user_id');

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/userLeft")
     * @Method({"POST"})
     */
    public function userLeftAction()
    {
        $postData = $this->get("request")->getContent();
        $data = \GuzzleHttp\json_decode($postData, 1);
        if (isset($data['DevEUI_uplink']['payload_hex'])) {
            $payload = $data['DevEUI_uplink']['payload_hex'];
            if ($payload == '0010' && isset($data['DevEUI_uplink']['DevEUI'])) {
                $devId = $data['DevEUI_uplink']['DevEUI'];
                $time = time();
                $now = date('Y-m-d H:i:s', $time);

                $sql = " 
                    SELECT r.*
                    FROM `parking_slot` AS `ps`
                    LEFT JOIN `reservation` AS `r` ON `r`.`parking_slot_id`=`ps`.`id` AND r.status=1 AND r.availability=1
                    WHERE `ps`.`name` = ? AND `r`.`start_time` <= ?;
                ";

                $em = $this->getDoctrine()->getManager();
                $stmt = $em->getConnection()->prepare($sql);
                $stmt->execute(array($devId, $now));

                $reservations = $stmt->fetchAll();
                if (count($reservations)) {
                    $repository = $this->getDoctrine()->getRepository(Reservation::class);
                    $reservation = $repository->find($reservations[0]['id']);
                    $reservation->setAvailability(0);
                    $em->persist($reservation);

                    $endTime = $reservation->getEndTime()->format('U');
                    if ($endTime < $time) {
                        $minutesExtra = ($time - $endTime) / 60;
                        $penalty = new Penalty();
                        $penalty->setExtraTime($minutesExtra);
                        $penalty->setReservation($reservation);
                        $em->persist($penalty);
                    }
                    $em->flush();
                    return new Response('{"status":1}');
                }
            }
        }

        /*
         * {"DevEUI_uplink": {"Time": "2017-09-23T03:50:09.47+02:00","DevEUI": "78AF580300000315","FPort": "1","FCntUp": "78","ADRbit": "1","MType": "2","FCntDn": "11","payload_hex": "1234","mic_hex": "6db48604","Lrcid": "00000127","LrrRSSI": "-34.000000","LrrSNR": "10.250000","SpFact": "7","SubBand": "G0","Channel": "LC1","DevLrrCnt": "3","Lrrid": "C00002C6","Late": "0","LrrLAT": "0.000000","LrrLON": "0.000000","Lrrs": {"Lrr": [{"Lrrid": "C00002C6","Chain": "0","LrrRSSI": "-34.000000","LrrSNR": "10.250000","LrrESP": "-34.391785"},{"Lrrid": "004A0A14","Chain": "0","LrrRSSI": "-42.000000","LrrSNR": "10.500000","LrrESP": "-42.370777"},{"Lrrid": "C00001D8","Chain": "0","LrrRSSI": "-77.000000","LrrSNR": "10.250000","LrrESP": "-77.391785"}]},"CustomerID": "100023338","CustomerData": {"alr":{"pro":"LORA/Generic","ver":"1"}},"ModelCfg": "0","AppSKey": "7a4c2378f1a1da771345d81d700b3c0a","InstantPER": "0.000000","MeanPER": "0.036125","DevAddr": "041B4E78","AckRequested": "0","rawMacCommands": ""}}
         */

        return new Response('{"status":0}');
    }

    /**
     * @Route("/unlock")
     * @Method({"POST"})
     */
    public function letMeInAction()
    {
        $session = new Session();
        $userId = $session->get('user_id');
        if ($userId) {
            $repository = $this->getDoctrine()->getRepository(Users::class);
            $user = $repository->find($userId);
            if ($user->getId()) {
                $now = date('Y-m-d H:i:s');
                $reservationsRepository = $this->getDoctrine()->getRepository(Reservation::class);
                $parkindSlotsRepository = $this->getDoctrine()->getRepository(ParkingSlot::class);

                $sql = " 
                    SELECT r.*
                    FROM `reservation` AS `r`
                    WHERE r.status=1 AND r.availability=0 AND user_id = ?
                    AND `r`.`start_time` <= ? AND `r`.`end_time` >= ?
                    LIMIT 1;
                ";

                $em = $this->getDoctrine()->getManager();
                $stmt = $em->getConnection()->prepare($sql);
                $stmt->execute(array($userId, $now, $now));

                $reservations = $stmt->fetchAll();
                if (isset($reservations[0])) {
                    $parkingSlotId = $reservations[0]['parking_slot_id'];
                    $reservationId = $reservations[0]['id'];
                    $reservation = $reservationsRepository->find($reservationId);
                    $parkingSlot = $parkindSlotsRepository->find($parkingSlotId);
                    $url = 'http://beta.giotty.com/api/v1/nodes/send_data_to_node/'.$parkingSlot->getNodeName().'?auth_token=NuLzGxeMYMfHBPBfaEPpNRjy&payload=00';

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    $response = curl_exec($ch);
                    $responseData = json_decode($response, 1);
                    if (isset($responseData['status']) && $responseData['status'] == 'SUCCESS') {
                        $reservation->setAvailability(1);
                        $em->persist($reservation);
                        $em->flush();

                        return new Response('{"status":1}');
                    }
                }
            }
        }

        return new Response('{"status":0}');
    }
}
