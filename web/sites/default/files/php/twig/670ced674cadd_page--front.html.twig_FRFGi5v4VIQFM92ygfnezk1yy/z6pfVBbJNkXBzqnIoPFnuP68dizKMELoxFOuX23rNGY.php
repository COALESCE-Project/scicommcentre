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

/* themes/xara/templates/layout/page--front.html.twig */
class __TwigTemplate_1aaf97f030907c855d7eaa5b270e2c34 extends Template
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
        $this->loadTemplate("@xara/template-parts/header.html.twig", "themes/xara/templates/layout/page--front.html.twig", 1)->display($context);
        // line 2
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 2)) {
            // line 3
            echo "  ";
            $this->loadTemplate("@thex/template-parts/highlighted.html.twig", "themes/xara/templates/layout/page--front.html.twig", 3)->display($context);
        }
        // line 5
        echo "<div class=\"main-wrapper\">
  ";
        // line 6
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_home_top", [], "any", false, false, true, 6)) {
            // line 7
            echo "    ";
            $this->loadTemplate("@thex/template-parts/content-parts/content_home_top.html.twig", "themes/xara/templates/layout/page--front.html.twig", 7)->display($context);
            // line 8
            echo "  ";
        }
        // line 9
        echo "  <div class=\"container\">
    <div class=\"main-container\">
      <main id=\"main\" class=\"main-content front-content\">
        <a id=\"main-content\" tabindex=\"-1\"></a>
        ";
        // line 13
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_top", [], "any", false, false, true, 13)) {
            // line 14
            echo "          ";
            $this->loadTemplate("@thex/template-parts/content-parts/content_top.html.twig", "themes/xara/templates/layout/page--front.html.twig", 14)->display($context);
            // line 15
            echo "        ";
        }
        // line 16
        echo "        <div class=\"node-content\">
          ";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
        echo "
        </div>
        ";
        // line 19
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_bottom", [], "any", false, false, true, 19)) {
            // line 20
            echo "          ";
            $this->loadTemplate("@thex/template-parts/content-parts/content_bottom.html.twig", "themes/xara/templates/layout/page--front.html.twig", 20)->display($context);
            // line 21
            echo "        ";
        }
        // line 22
        echo "      </main>
    ";
        // line 23
        if ((($context["front_sidebar"] ?? null) && twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 23))) {
            // line 24
            echo "      ";
            $this->loadTemplate("@thex/template-parts/sidebar/sidebar_left.html.twig", "themes/xara/templates/layout/page--front.html.twig", 24)->display($context);
            // line 25
            echo "    ";
        }
        // line 26
        echo "    ";
        if ((($context["front_sidebar"] ?? null) && twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 26))) {
            // line 27
            echo "      ";
            $this->loadTemplate("@thex/template-parts/sidebar/sidebar_right.html.twig", "themes/xara/templates/layout/page--front.html.twig", 27)->display($context);
            // line 28
            echo "    ";
        }
        // line 29
        echo "    </div><!--/main-container -->
  </div><!--/container -->
  ";
        // line 31
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content_home_bottom", [], "any", false, false, true, 31)) {
            // line 32
            echo "    ";
            $this->loadTemplate("@thex/template-parts/content-parts/content_home_bottom.html.twig", "themes/xara/templates/layout/page--front.html.twig", 32)->display($context);
            // line 33
            echo "  ";
        }
        // line 34
        echo "</div><!--/main-wrapper -->
";
        // line 35
        $this->loadTemplate("@xara/template-parts/footer.html.twig", "themes/xara/templates/layout/page--front.html.twig", 35)->display($context);
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "front_sidebar"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/xara/templates/layout/page--front.html.twig";
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
        return array (  123 => 35,  120 => 34,  117 => 33,  114 => 32,  112 => 31,  108 => 29,  105 => 28,  102 => 27,  99 => 26,  96 => 25,  93 => 24,  91 => 23,  88 => 22,  85 => 21,  82 => 20,  80 => 19,  75 => 17,  72 => 16,  69 => 15,  66 => 14,  64 => 13,  58 => 9,  55 => 8,  52 => 7,  50 => 6,  47 => 5,  43 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/xara/templates/layout/page--front.html.twig", "C:\\xampp\\htdocs\\scicommcentre\\web\\themes\\xara\\templates\\layout\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("include" => 1, "if" => 2);
        static $filters = array("escape" => 17);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['include', 'if'],
                ['escape'],
                []
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
