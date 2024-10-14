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

/* @thex/template-parts/footer/footer-blocks.html.twig */
class __TwigTemplate_1dfc6d6f29009ed114e7bd0496d7fdc4 extends Template
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
        echo "<footer class=\"footer-blocks footer\">
  <div class=\"container\">
    <div class=\"footer-blocks-container\">
      ";
        // line 4
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_one", [], "any", false, false, true, 4)) {
            // line 5
            echo "        <div class=\"footer-block footer-one\">
          ";
            // line 6
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_one", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 9
        echo "      ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_two", [], "any", false, false, true, 9)) {
            // line 10
            echo "        <div class=\"footer-block footer-two\">
          ";
            // line 11
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_two", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 14
        echo "      ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_three", [], "any", false, false, true, 14)) {
            // line 15
            echo "        <div class=\"footer-block footer-three\">
          ";
            // line 16
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_three", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 19
        echo "      ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_four", [], "any", false, false, true, 19)) {
            // line 20
            echo "        <div class=\"footer-block footer-four\">
          ";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_four", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 24
        echo "    </div><!-- /footer-top-container -->
  </div><!-- /container -->
</footer><!-- /footer-top -->
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@thex/template-parts/footer/footer-blocks.html.twig";
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
        return array (  91 => 24,  85 => 21,  82 => 20,  79 => 19,  73 => 16,  70 => 15,  67 => 14,  61 => 11,  58 => 10,  55 => 9,  49 => 6,  46 => 5,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@thex/template-parts/footer/footer-blocks.html.twig", "C:\\xampp\\htdocs\\scicommcentre\\web\\themes\\thex\\templates\\template-parts\\footer\\footer-blocks.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 4);
        static $filters = array("escape" => 6);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
