public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // User ID (Primary Key)
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('phone')->unique();
        $table->string('password');
        $table->timestamps();
    });
}
