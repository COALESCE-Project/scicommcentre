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

/* @xara/template-parts/footer.html.twig */
class __TwigTemplate_b62ce08c9b6f84ee8e6a412a4b8f7fea extends Template
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
        echo "<footer class=\"site-footer footer\">
";
        // line 2
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_top", [], "any", false, false, true, 2)) {
            // line 3
            echo "  ";
            $this->loadTemplate("@thex/template-parts/footer/footer-top.html.twig", "@xara/template-parts/footer.html.twig", 3)->display($context);
        }
        // line 5
        if ((((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_one", [], "any", false, false, true, 5) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_two", [], "any", false, false, true, 5)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_three", [], "any", false, false, true, 5)) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_four", [], "any", false, false, true, 5))) {
            // line 6
            echo "  ";
            $this->loadTemplate("@thex/template-parts/footer/footer-blocks.html.twig", "@xara/template-parts/footer.html.twig", 6)->display($context);
        }
        // line 8
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom_left", [], "any", false, false, true, 8) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom_right", [], "any", false, false, true, 8))) {
            // line 9
            echo "  ";
            $this->loadTemplate("@thex/template-parts/footer/footer-bottom-blocks.html.twig", "@xara/template-parts/footer.html.twig", 9)->display($context);
        }
        // line 11
        if ((($context["copyright_text"] ?? null) || twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_bottom_last", [], "any", false, false, true, 11))) {
            // line 12
            echo "  <footer class=\"footer-bottom footer\">
    <div class=\"container\">
      <div class=\"footer-bottom-container\">
        ";
            // line 15
            if (($context["copyright_text"] ?? null)) {
                // line 16
                echo "          ";
                $this->loadTemplate("@thex/template-parts/footer/footer-copyright.html.twig", "@xara/template-parts/footer.html.twig", 16)->display($context);
                // line 17
                echo "        ";
            }
            // line 18
            echo "        ";
            $this->loadTemplate("@thex/template-parts/footer/footer-bottom-last.html.twig", "@xara/template-parts/footer.html.twig", 18)->display($context);
            // line 19
            echo "      ";
            if (($context["social_icons_show"] ?? null)) {
                // line 20
                echo "        <div class=\"footer-social\">
          ";
                // line 21
                $this->loadTemplate("@xara/template-parts/social-icons.html.twig", "@xara/template-parts/footer.html.twig", 21)->display($context);
                // line 22
                echo "        </div>
      ";
            }
            // line 24
            echo "      </div><!-- /footer-bottom-container -->
    </div><!-- /container -->
  </footer><!-- /footer-bottom -->
";
        }
        // line 28
        echo "</footer>
";
        // line 29
        if (($context["scrolltotop_on"] ?? null)) {
            // line 30
            echo "  <div class=\"scrolltop\"><i class=\"icon-arrow-up\"></i></div>
";
        }
        // line 32
        $this->loadTemplate("@xara/template-parts/style.html.twig", "@xara/template-parts/footer.html.twig", 32)->display($context);
        // line 33
        if (($context["fontawesome_four"] ?? null)) {
            // line 34
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("thex/fontawesome4"), "html", null, true);
            echo "
";
        }
        // line 36
        if (($context["fontawesome_five"] ?? null)) {
            // line 37
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("thex/fontawesome5"), "html", null, true);
            echo "
";
        }
        // line 39
        if (($context["bootstrapicons"] ?? null)) {
            // line 40
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("thex/bootstrap-icons"), "html", null, true);
            echo "
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "copyright_text", "social_icons_show", "scrolltotop_on", "fontawesome_four", "fontawesome_five", "bootstrapicons"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@xara/template-parts/footer.html.twig";
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
        return array (  125 => 40,  123 => 39,  117 => 37,  115 => 36,  109 => 34,  107 => 33,  105 => 32,  101 => 30,  99 => 29,  96 => 28,  90 => 24,  86 => 22,  84 => 21,  81 => 20,  78 => 19,  75 => 18,  72 => 17,  69 => 16,  67 => 15,  62 => 12,  60 => 11,  56 => 9,  54 => 8,  50 => 6,  48 => 5,  44 => 3,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@xara/template-parts/footer.html.twig", "C:\\xampp\\htdocs\\scicommcentre\\web\\themes\\xara\\templates\\template-parts\\footer.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 2, "include" => 3);
        static $filters = array("escape" => 34);
        static $functions = array("attach_library" => 34);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'include'],
                ['escape'],
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
