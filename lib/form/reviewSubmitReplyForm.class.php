<?php


class reviewSubmitReplyForm extends reviewSubmitForm
{
	public function configure()
	{
		unset($this['gen_char'], $this['matches'], $this['send_to'], $this['mat_original'],
		  $this['published_before_full'], $this['published_before_part'], $this['new_theor'],
		  $this['new_exp'], $this['not_new'], $this['error'], $this['original'], $this['present'],
		  $this['total'], $this['reduce_by']);
	}
}