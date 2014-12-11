<?php
/**
 * Created by PhpStorm.
 * User: Ondrej
 * Date: 12/11/2014
 * Time: 11:01 AM
 */

namespace App\Presenters;


class DashboardPresenter extends BasePresenter
{
	/**
	 * @var \IPub\WidgetsManager\WidgetsProvider
	 * @inject
	 */
	public $widgetsProvider;

	public function renderDefault()
	{
		$widgets = [];

		// Get widgets metoda je na tobě, mě to konkrétně vrací pole s názvem a konfigurací:
		// 123 => array[
		//      params => array[
		//          location => "Brno, Czech Republic"
		//          id => "3078610"
		//          units => "metric"
		//      ]
		//      type => "widget.weather"
		//  ]

		$getWidgetsArray = [123 =>
									['params' => ['location' => "Brno, Czech Republic", 'id' => "3078610", 'units' => "metric" ],
									 'type' => "widget.weather"],
							];


//		dump($getWidgetsArray);

//		foreach ($this->getWidgets() as $id => $data) {
		foreach ($getWidgetsArray as $id => $data) {


//			echo $data['type'];

			// Z provideru si vytáhneš onen widget
			if ($widget = $this->widgetsProvider->get($data['type'])) {
				// A jednoduše jej renderuješ, nic se nevykreslí, celé se ti to uloží do proměnné
				$widgets[$id] = $widget->render($data);
			}
		}

		$this->template->widgets = $widgets;
	}
}