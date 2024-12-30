<?php

namespace Drupal\views\Plugin\views\sort;

use Drupal\views\Plugin\views\sort\SortPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a Views sort plugin for sorting by creation date.
 *
 * @ViewsSort(
 *   id = "created_sort",
 *   title = @Translation("Creation Date"),
 *   help = @Translation("Sort by the creation date of the entity."),
 *   default_sort_order = "DESC",
 * )
 */
class CreatedSort extends SortPluginBase {

  /**
   * Adds the sorting condition to the query.
   *
   * {@inheritdoc}
   */
  public function query() {
    // Add an ORDER BY clause to sort by the 'created' field of the node.
    $this->query->add_orderby('node.created', $this->options['order']);
  }

  /**
   * Builds the options form for the sort plugin.
   *
   * {@inheritdoc}
   */
  public function options_form(&$form, FormStateInterface $form_state) {
    // Retrieve the parent form's options.
    $form = parent::options_form($form, $form_state);
    
    // Add a dropdown to select the sorting order (ascending or descending).
    $form['order'] = [
      '#type' => 'select',
      '#title' => t('Order'),
      '#options' => [
        'ASC' => t('Ascending'),
        'DESC' => t('Descending'),
      ],
      '#default_value' => $this->options['order'], // Set the default sorting order.
      '#description' => t('Select the sorting order.'), // Provide a description for the dropdown.
    ];

    // Return the modified form.
    return $form;
  }
}
