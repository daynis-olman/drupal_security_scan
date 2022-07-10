(function ($, Drupal, drupalSettings) {
  const copyToClipboard = (text) => {
    let sampleTextarea = document.createElement("textarea");
    document.body.appendChild(sampleTextarea);
    sampleTextarea.value = text;
    sampleTextarea.select();
    document.execCommand("copy");
    document.body.removeChild(sampleTextarea);
  }

  /**
   * Attach the copy to clipboard behavior.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attach the copy to clipboard behavior.
   */
  Drupal.behaviors.copyTokenBehaviour = {
    attach: function (context, settings) {
      $('.copy-clipboard', context).once('copyToken').each(function () {
        $(this).click(function (e) {
          const tokenElement = document.querySelector('[data-drupal-selector="edit-token"]');
          const token = tokenElement ? tokenElement.value.trim() : '';
          copyToClipboard(token);
        });
      });
    }
  };

})(jQuery, Drupal, drupalSettings);
