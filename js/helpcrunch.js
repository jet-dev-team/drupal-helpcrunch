(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.helpCrunch = {
    attach: function (context) {
      if (context !== document) return;

      if (drupalSettings.drupal_helpcrunch) {
        var USER = drupalSettings.drupal_helpcrunch.helpCrunch.displayName;
        var SETTINGS = drupalSettings.drupal_helpcrunch.helpCrunch.settings;
      }

      (function (w, d) {
        w.HelpCrunch = function () {
          w.HelpCrunch.q.push(arguments)
        };
        w.HelpCrunch.q = [];

        function r() {
          var s = document.createElement('script');
          s.async = 1;
          s.type = 'text/javascript';
          s.src = 'https://widget.helpcrunch.com/';
          (d.body || d.head).appendChild(s);
        }

        if (w.attachEvent) {
          w.attachEvent('onload', r)
        } else {
          w.addEventListener('load', r, false)
        }
      })(window, document)

      if (SETTINGS) {
        HelpCrunch('init', SETTINGS.widget_name, {
          applicationId: SETTINGS.application_id,
          applicationSecret: SETTINGS.application_secret
        })

        HelpCrunch('showChatWidget');
      }

      if (USER) {
        HelpCrunch('updateUser', USER);
      }
    }
  };
})(jQuery, Drupal, drupalSettings);

