<?php


namespace Riclep\Storyblok\Fields;


use Illuminate\Support\Arr;
use Riclep\Storyblok\Field;

class Table extends Field
{
	/**
	 * @var string a class to apply to the <table> tag
	 */
	protected $cssClass;

	/**
	 * @var array|int the column numbers to convert to headers
	 */
	protected $headerColumns;



	public function __toString()
	{
		return $this->toHtml($this->content);
	}

	private function toHtml($table) {
		$html = '<table ' . ($this->cssClass ? 'class="' . $this->cssClass . '"' : null) . '><thead><tr>';

		foreach ($table['thead'] as $header) {
			$html .= '<th>' . $header['value'] . '</th>';
		}

		$html .= '</tr></thead><tbody>';

		foreach ($table['tbody'] as $row) {
			$html .= '<tr>';

			foreach ($row['body'] as $column => $cell) {
				if ($this->headerColumns && in_array(($column + 1), Arr::wrap($this->headerColumns))) {
					$html .= '<th>' . $cell['value'] . '</th>';
				} else {
					$html .= '<td>' . $cell['value'] . '</td>';
				}
			}

			$html .= '</tr>';
		}

		return $html . '</tbody></table>';
	}
}