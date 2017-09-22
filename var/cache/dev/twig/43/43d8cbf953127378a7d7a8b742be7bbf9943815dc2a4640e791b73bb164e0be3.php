<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_a51992f6210b07c1454fda7e291ffcbeb22103414e00b28eef8cab5d7927ad97 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3e643a87b6556a4d8db4e2db02a42b2eeaa18a2ce4dd89b91a855d3b1089e30c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3e643a87b6556a4d8db4e2db02a42b2eeaa18a2ce4dd89b91a855d3b1089e30c->enter($__internal_3e643a87b6556a4d8db4e2db02a42b2eeaa18a2ce4dd89b91a855d3b1089e30c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3e643a87b6556a4d8db4e2db02a42b2eeaa18a2ce4dd89b91a855d3b1089e30c->leave($__internal_3e643a87b6556a4d8db4e2db02a42b2eeaa18a2ce4dd89b91a855d3b1089e30c_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_68bc4f7bf60b34708a709dc35d283a747eaec99a2ac1fd2557ba7bd3bbefccc0 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_68bc4f7bf60b34708a709dc35d283a747eaec99a2ac1fd2557ba7bd3bbefccc0->enter($__internal_68bc4f7bf60b34708a709dc35d283a747eaec99a2ac1fd2557ba7bd3bbefccc0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_68bc4f7bf60b34708a709dc35d283a747eaec99a2ac1fd2557ba7bd3bbefccc0->leave($__internal_68bc4f7bf60b34708a709dc35d283a747eaec99a2ac1fd2557ba7bd3bbefccc0_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_c634b645bbff24cbdfd55f6e45b57ca37e210cde157da7f5ca575234a56d0534 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c634b645bbff24cbdfd55f6e45b57ca37e210cde157da7f5ca575234a56d0534->enter($__internal_c634b645bbff24cbdfd55f6e45b57ca37e210cde157da7f5ca575234a56d0534_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_c634b645bbff24cbdfd55f6e45b57ca37e210cde157da7f5ca575234a56d0534->leave($__internal_c634b645bbff24cbdfd55f6e45b57ca37e210cde157da7f5ca575234a56d0534_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_a247b40714a4d5d5fe328a8697119cf81448b965812bead2832a5779478d1b03 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a247b40714a4d5d5fe328a8697119cf81448b965812bead2832a5779478d1b03->enter($__internal_a247b40714a4d5d5fe328a8697119cf81448b965812bead2832a5779478d1b03_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_a247b40714a4d5d5fe328a8697119cf81448b965812bead2832a5779478d1b03->leave($__internal_a247b40714a4d5d5fe328a8697119cf81448b965812bead2832a5779478d1b03_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "C:\\xampp\\htdocs\\urbanparking.ro\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\WebProfilerBundle\\Resources\\views\\Collector\\router.html.twig");
    }
}
