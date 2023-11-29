<?php

namespace Drupal\reseau_mod_up_formation\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'field_libelle_resultat' widget.
 *
 * @FieldWidget(
 *   id = "field_libelle_resultat_widget",
 *   module = "reseau_mod_up_formation",
 *   label = @Translation("Affiche options Libéllé dans select"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class FieldLibelleResultatWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    $vid = 'libelles_resultats_formations';
    /** @var \Drupal\taxonomy\Entity\Term[] $terms */
    $terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties(['vid' => $vid]);
// dsm($terms);
foreach ($terms as $term) {
// $term_data[ $term->id()] = $term->getName();
$term_data_name[$term->getName()] = $term->getName();
}

    // dsm($element);
    // dsm($term_data);
    // dsm($term_data_name);
    // dsm($value);
    if (isset($items[$delta]->value)) {
      if (in_array($value, $term_data_name)) {
        // dsm($value);
        $element += [
           '#default_value' => $value,
          '#type' => 'select',   
          '#options' => $term_data_name,
        ];
      }
      else {
      $element += [
        '#type' => 'textfield',
        '#default_value' => $value,
 
        // '#size' => 7,
        // '#maxlength' => 7,
        // '#element_validate' => [
        //   [static::class, 'validate'],
        // ],
      ];
    }
    }
    else {
  

//  dsm($term_data);
    $element += [
      // '#type' => 'textfield',
      // '#default_value' => $value,
      '#type' => 'select',
      // '#title' => t('User'),
      // '#description' => t('Select group members from the list.'),
      '#options' => $term_data_name,
      // '#size' => 7,
      // '#maxlength' => 7,
      // '#element_validate' => [
      //   [static::class, 'validate'],
      // ],
    ];
  }
  // dsm($element);
    return ['value' => $element];
  }

  /**
   * Validate the color text field.
   */
  public static function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    // dsm($element);
    // if (strlen($value) == 0) {
    //   $form_state->setValueForElement($element, '');
    //   return;
    // }
    // if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
    //   $form_state->setError($element, t("Color must be a 6-digit hexadecimal value, suitable for CSS."));
    // }
  }

}