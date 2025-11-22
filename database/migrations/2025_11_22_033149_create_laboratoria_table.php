public function up()
{
    Schema::create('laboratorium', function (Blueprint $table) {
        $table->id();
        $table->string('no_antrian');
        $table->string('nama_pasien');
        $table->string('dari'); // poli asal
        $table->string('jenis_bayar'); // BPJS / Umum / Asuransi
        $table->enum('status', ['Sedang Antri', 'Telah Dilayani']);
        $table->timestamps();
    });
}
