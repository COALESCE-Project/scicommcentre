<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @xara/template-parts/slider.html.twig */
class __TwigTemplate_69889da3366d7f0ea4222f62f148c73a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("xara/slider"), "html", null, true);
        echo "
<section class=\"slider\">
  <div class=\"container\">
  <div class=\"slider-container\">
    <div class=\"slider-text\">
      <ul class=\"js-rotating\">
        ";
        // line 7
        if ((($context["slider_code"] ?? null) != "")) {
            // line 8
            echo "          ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_striptags($this->sandbox->ensureToStringAllowed(($context["slider_code"] ?? null), 8, $this->source), "<ol>,<ul>,<li>,<p>,<a>,<img>,<video>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<em>,<strong>,<br>,<i>,<button>,<mark>,<hr>,<div>"));
            echo "
        ";
        } else {
            // line 10
            echo "        <li>
  \t\t\t\t<h1>Simple, <em>Modern</em> and Expertly Crafted</h1>
  \t\t\t\t<p>XARA is packed full of all the amazing features and options for you to create an amazing edication website.</p>
  \t\t\t\t<a class=\"button\" href=\"#\">Get Started</a>
  \t\t\t</li>
  \t\t\t<li>
  \t\t\t\t<h1>Light Weight and <em>Fast</em> to boost Performance</h1>
  \t\t\t\t<p>We are committed to your digital performance. With awesome features its amazing fast.</p>
  \t\t\t\t<a class=\"button\" href=\"#\">Get Started</a>
  \t\t\t</li>
  \t\t\t<li>
  \t\t\t\t<h1>Satisfied customer is the best business strategy</h1>
  \t\t\t\t<p>We have high academic programs and fully qualified faculties with over 12 years of teaching experience.</p>
  \t\t\t\t<a class=\"button\" href=\"#\">Get Started</a>
  \t\t\t</li>
        ";
        }
        // line 26
        echo "      </ul> <!--/.home-slider -->
    </div><!-- /slider-text -->
    <div class=\"slider-image\">
      ";
        // line 29
        if ((($context["slider_image_path"] ?? null) != "")) {
            // line 30
            echo "        <img src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["slider_image_path"] ?? null), 30, $this->source), "html", null, true);
            echo "\" alt=\"slider image\" />
      ";
        } else {
            // line 32
            echo "        <img src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null), 32, $this->source), "html", null, true);
            echo "/images/demo/slider.svg\" alt=\"slider image\" />
      ";
        }
        // line 34
        echo "    </div><!-- /slider-image -->
  </div> <!--/.slider-container -->
  </div> <!--/.container -->
</section>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["slider_code", "slider_image_path", "directory"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@xara/template-parts/slider.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  93 => 34,  87 => 32,  81 => 30,  79 => 29,  74 => 26,  56 => 10,  50 => 8,  48 => 7,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@xara/template-parts/slider.html.twig", "C:\\Data\\xampp\\htdocs\\scicommcentre\\web\\themes\\xara\\templates\\template-parts\\slider.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 7);
        static $filters = array("escape" => 1, "raw" => 8, "striptags" => 8);
        static $functions = array("attach_library" => 1);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'raw', 'striptags'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
