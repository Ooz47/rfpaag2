<?php

namespace Drupal\reseau_mod_up_webform\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\webform\Entity\WebformSubmission;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebformSubmissionApproveController.
 *
 * @package Drupal\reseau_mod_up_webform\Controller
 */
class WebformSubmissionChangerStatutController extends ControllerBase {

  /**
   * Approve method.
   *
   * @param \Drupal\webform\Entity\WebformSubmission $submission
   *   A webform submission.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current HTTP request.
   *
   * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
   *   The response.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function marquerTraiteFormation(WebformSubmission $submission, Request $request) {

 $timezone = new \DateTimeZone('America/Guadeloupe');
 $now = DrupalDateTime::createFromTimestamp(time(),$timezone);
 
 // $now->setTimezone(new \DateTimeZone('America/Guadeloupe'));
//  dsm($submission->getElementData('traite_le'));
//  dsm($now);
//  dsm($now->format('Y-m-d\TH:i:sP'));

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-formation');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité: Entré.e en formation.', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraiteAttente(WebformSubmission $submission, Request $request) {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(),$timezone);
    
    // $now->setTimezone(new \DateTimeZone('America/Guadeloupe'));
   //  dsm($submission->getElementData('traite_le'));
   //  dsm($now);
   //  dsm($now->format('Y-m-d\TH:i:sP'));
   
       $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
       $submission->setElementData('statut', 'Traité-attente');
       $submission->save();
   
       $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité: En attente d’intégrer une formation.', [
         '@serial' => $submission->serial(),
       ]));
   
       return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
     }

     public function marquerTraiteOriente(WebformSubmission $submission, Request $request) {

      $timezone = new \DateTimeZone('America/Guadeloupe');
      $now = DrupalDateTime::createFromTimestamp(time(),$timezone);
      
      // $now->setTimezone(new \DateTimeZone('America/Guadeloupe'));
     //  dsm($submission->getElementData('traite_le'));
     //  dsm($now);
     //  dsm($now->format('Y-m-d\TH:i:sP'));
     
         $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
         $submission->setElementData('statut', 'Traité-orienté');
         $submission->save();
     
         $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité: Orienté.e vers une autre structure.', [
           '@serial' => $submission->serial(),
         ]));
     
         return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
       }

  public function marquerEncours(WebformSubmission $submission, Request $request) {
   
       $submission->setElementData('traite_le', '');
       $submission->setElementData('statut', 'En cours');
       $submission->save();
   
       $this->messenger()->addMessage($this->t('Statut demande @serial modifié: En cours.', [
         '@serial' => $submission->serial(),
       ]));
   
       return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
     }

  /**
   * Checks access for a specific request.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function access(WebformSubmission $submission) {
    return AccessResult::allowedIf(!$submission->isDraft() && array_intersect(array('administrator','gestionnaire_formulaire_greta_guadeloupe'), $this->currentUser()->getRoles())!== []);
  }

}