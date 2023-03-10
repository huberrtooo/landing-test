<?php
/**
 * @package   awf
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or later
 */

namespace Awf\Mvc\DataModel\Filter;


class Number extends AbstractFilter
{
	/**
	 * The partial match is mapped to an exact match
	 *
	 * @param   mixed  $value  The value to compare to
	 *
	 * @return  string  The SQL where clause for this search
	 */
	public function partial($value)
	{
		return $this->exact($value);
	}

	/**
	 * Perform a between limits match. When $include is true
	 * the condition tested is:
	 * $from <= VALUE <= $to
	 * When $include is false the condition tested is:
	 * $from < VALUE < $to
	 *
	 * @param   mixed    $from     The lowest value to compare to
	 * @param   mixed    $to       The higherst value to compare to
	 * @param   boolean  $include  Should we include the boundaries in the search?
	 *
	 * @return  string  The SQL where clause for this search
	 */
	public function between($from, $to, $include = true)
	{
		$from = (float) $from;
		$to   = (float) $to;

		if ($this->isEmpty($from) || $this->isEmpty($to))
		{
			return '';
		}

		$extra = '';

		if ($include)
		{
			$extra = '=';
		}

		$sql = '((' . $this->getFieldName() . ' >' . $extra . ' ' . $from . ') AND ';
		$sql .= '(' . $this->getFieldName() . ' <' . $extra . ' ' . $to . '))';

		return $sql;
	}

	/**
	 * Perform an outside limits match. When $include is true
	 * the condition tested is:
	 * (VALUE <= $from) || (VALUE >= $to)
	 * When $include is false the condition tested is:
	 * (VALUE < $from) || (VALUE > $to)
	 *
	 * @param   mixed    $from     The lowest value of the excluded range
	 * @param   mixed    $to       The higherst value of the excluded range
	 * @param   boolean  $include  Should we include the boundaries in the search?
	 *
	 * @return  string  The SQL where clause for this search
	 */
	public function outside($from, $to, $include = false)
	{
		$from = (float) $from;
		$to   = (float) $to;

		if ($this->isEmpty($from) || $this->isEmpty($to))
		{
			return '';
		}

		$extra = '';

		if ($include)
		{
			$extra = '=';
		}

		$sql = '((' . $this->getFieldName() . ' <' . $extra . ' ' . $from . ') AND ';
		$sql .= '(' . $this->getFieldName() . ' >' . $extra . ' ' . $to . '))';

		return $sql;
	}

	/**
	 * Perform an interval match. It's similar to a 'between' match, but the
	 * from and to values are calculated based on $value and $interval:
	 * $value - $interval < VALUE < $value + $interval
	 *
	 * @param   integer|float  $value     The center value of the search space
	 * @param   integer|float  $interval  The width of the search space
	 * @param   boolean        $include   Should I include the boundaries in the search?
	 *
	 * @return  string  The SQL where clause
	 */
	public function interval($value, $interval, $include = true)
	{
		if ($this->isEmpty($value))
		{
			return '';
		}

		// Convert them to float, just to be sure
		$value    = (float) $value;
		$interval = (float) $interval;

		$from = $value - $interval;
		$to = $value + $interval;

		$extra = '';

		if ($include)
		{
			$extra = '=';
		}

		$sql = '((' . $this->getFieldName() . ' >' . $extra . ' ' . $from . ') AND ';
		$sql .= '(' . $this->getFieldName() . ' <' . $extra . ' ' . $to . '))';

		return $sql;
	}
}
