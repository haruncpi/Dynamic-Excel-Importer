<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration {

	public function up()
	{
		Schema::create('cases', function(Blueprint $table)
		{
			$table->bigIncrements('id');

			$table->string('case_no');
			$table->date('order_date');
			$table->string('applicant');
			$table->string('mobile');
			$table->number('s_ledger_no');
			$table->number('bs_no');
			$table->number('land_qty');
			$table->string('grantor');
			$table->string('grantor_mobile');
			$table->number('c_ledger_no'); //agotho ledger no
			$table->string('tc',1);
			$table->string('mowja');

			$table->string('year',4);
			$table->string('attachment');
			$table->string('attachment_id');
			$table->string('dcr_no');
			$table->string('photo');
			$table->string('user_id');
			$table->text('remarks');
			$table->string('status');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('cases');
	}

}
