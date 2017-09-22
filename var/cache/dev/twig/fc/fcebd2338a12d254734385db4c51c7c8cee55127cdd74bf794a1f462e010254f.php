<?php

/* base.html.twig */
class __TwigTemplate_1e2f52293538383ac45c95eaf3685683d1ed33048bb4a8072499580aedb63891 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0f662fd838fc25f26f8950c6951bfebb0ef7e273fd4f8b8b86dd5f729c48187f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_0f662fd838fc25f26f8950c6951bfebb0ef7e273fd4f8b8b86dd5f729c48187f->enter($__internal_0f662fd838fc25f26f8950c6951bfebb0ef7e273fd4f8b8b86dd5f729c48187f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_0f662fd838fc25f26f8950c6951bfebb0ef7e273fd4f8b8b86dd5f729c48187f->leave($__internal_0f662fd838fc25f26f8950c6951bfebb0ef7e273fd4f8b8b86dd5f729c48187f_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_e7070e0b2eda347445f99815ad414dffba366b6ee25e9f0d6ff3d41c5905c385 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e7070e0b2eda347445f99815ad414dffba366b6ee25e9f0d6ff3d41c5905c385->enter($__internal_e7070e0b2eda347445f99815ad414dffba366b6ee25e9f0d6ff3d41c5905c385_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_e7070e0b2eda347445f99815ad414dffba366b6ee25e9f0d6ff3d41c5905c385->leave($__internal_e7070e0b2eda347445f99815ad414dffba366b6ee25e9f0d6ff3d41c5905c385_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_8c041a53205330834ec754727a4cbae0e500915992be5a6d241e57106a9f2ebd = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_8c041a53205330834ec754727a4cbae0e500915992be5a6d241e57106a9f2ebd->enter($__internal_8c041a53205330834ec754727a4cbae0e500915992be5a6d241e57106a9f2ebd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_8c041a53205330834ec754727a4cbae0e500915992be5a6d241e57106a9f2ebd->leave($__internal_8c041a53205330834ec754727a4cbae0e500915992be5a6d241e57106a9f2ebd_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_de97142439545a1cd6c1087f1db5832b9dbe012fccd5af86378161d387ab3795 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_de97142439545a1cd6c1087f1db5832b9dbe012fccd5af86378161d387ab3795->enter($__internal_de97142439545a1cd6c1087f1db5832b9dbe012fccd5af86378161d387ab3795_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_de97142439545a1cd6c1087f1db5832b9dbe012fccd5af86378161d387ab3795->leave($__internal_de97142439545a1cd6c1087f1db5832b9dbe012fccd5af86378161d387ab3795_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_f9ff0e8b392a215762523c7dec3e6857983e8897102ab7793cd031591bc659a7 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f9ff0e8b392a215762523c7dec3e6857983e8897102ab7793cd031591bc659a7->enter($__internal_f9ff0e8b392a215762523c7dec3e6857983e8897102ab7793cd031591bc659a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_f9ff0e8b392a215762523c7dec3e6857983e8897102ab7793cd031591bc659a7->leave($__internal_f9ff0e8b392a215762523c7dec3e6857983e8897102ab7793cd031591bc659a7_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
", "base.html.twig", "C:\\xampp\\htdocs\\urbanparking.ro\\app\\Resources\\views\\base.html.twig");
    }
}
