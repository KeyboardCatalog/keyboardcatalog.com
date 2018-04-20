<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class AdSenseShortcode extends Shortcode
{
  public function init()
  {
    $this->shortcode->getHandlers()->add('adsense', function (ShortcodeInterface $sc) {
      // Do not display the ad if the active state is false
      if (!$this->twig->twig_vars['adsense_active']) return;

      $hash = $this->shortcode->getId($sc);
      $sandy = $sc->getParameter('sandy');
      $type = $sc->getParameter('type');
      $direction = $sc->getParameter('direction');
      $class = $sc->getParameter('class');

      $output = $this->twig->processTemplate('partials/adsense.html.twig', array(
          'adsense_hash' => $hash,
          'adsense_sandy' => $sandy ? $sandy : $this->twig->twig_vars['adsense_sandy'],
          'adsense_type' => $type ? $type : $this->twig->twig_vars['adsense_type'],
          'adsense_direction' => $direction ? $direction : $this->twig->twig_vars['adsense_direction'],
          'adsense_client' => $this->twig->twig_vars['adsense_client'],
          'adsense_slot' => $this->twig->twig_vars['adsense_slot'],
          'adsense_class' => $class,
      ));

      return $output;
    });
  }
}
