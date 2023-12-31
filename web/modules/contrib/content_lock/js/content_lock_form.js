/**
 * @file
 * Defines Javascript behaviors for the Content Lock button.
 */

(function ($, Drupal, once) {

  /**
   * Behaviors for tabs in the node edit form.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches automatic submission behavior for content lock buttons.
   */
  Drupal.behaviors.contentLockButton = {
    attach: function attach(context, drupalSettings) {
      if (!drupalSettings.content_lock) {
        return;
      }

      $.each(drupalSettings.content_lock, function (form_id, settings) {
        once('content-lock', 'form.' + form_id, context).forEach(function (elem) {
          new Drupal.content_lock(elem, settings);
        });
      })
    }
  };

  Drupal.content_lock = function (form, settings) {
    var that = this;

    var ajaxCall = Drupal.ajax({
      url: settings.lockUrl,
      element: form
    });

    ajaxCall.commands.insert = function () {
      if (arguments[1].selector === '') {
        arguments[1].selector = '#' + form.id;
      }
      Drupal.AjaxCommands.prototype.insert.apply(this, arguments);
    };

    ajaxCall.commands.lockForm = function (ajax, response, status) {
      if (response.lockable && response.lock !== true) {
        that.lock();
      }
    };

    ajaxCall.execute();

    this.lock = function () {
      var $form = $(form);
      $form.prop('disabled', true).addClass('is-disabled');
      $form.find('input, textarea, select').prop('disabled', true).addClass('is-disabled');
      $form.find('.content-lock-actions input').attr('title', Drupal.t('Action not available because content is locked.'));
      $form.find('#edit-field-thematiques').prop('disabled', true).trigger('chosen:updated');
      $form.find('#edit-field-financement').prop('disabled', true).trigger('chosen:updated');
      if (window.CKEDITOR) {
        for (let $instance in CKEDITOR.instances) {
          CKEDITOR.instances[$instance].setReadOnly();
        }
      }
    };

    var onBeforeUnLoadEvent = false;

    window.onunload = window.onbeforeunload= function() {
      if (!onBeforeUnLoadEvent) {
        onBeforeUnLoadEvent = true;
        if (typeof navigator.sendBeacon === 'function') {
          navigator.sendBeacon(settings.releaseUrl);
        }
      }
    };
  };

}(jQuery, Drupal, once));
