<?php

namespace Drupal\scalable_cybersec;

trait Utility {

  /**
   * Helper function to read composer file content.
   *
   * @param bool $lock_file
   *
   * @return false|array
   */
  public function readComposerFile(bool $lock_file = FALSE) {
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(getcwd());

    $file_name = $lock_file ? 'composer.lock' : 'composer.json';
    $file_path = $drupalFinder->getComposerRoot() . '/' . $file_name;

    if (file_exists($file_path)) {
      $content = file_get_contents($file_path);
      return json_decode($content, TRUE);
    }

    return NULL;
  }

}
