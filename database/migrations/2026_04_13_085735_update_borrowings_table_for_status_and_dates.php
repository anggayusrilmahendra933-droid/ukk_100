<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            // Ubah enum status untuk menyertakan pending dan rejected
            $table->enum('status', ['borrowed', 'returned', 'overdue', 'pending', 'rejected'])
                  ->default('pending')
                  ->change();
            
            // Buat tanggal pinjam dan jatuh tempo menjadi nullable karena diisi saat approval
            $table->date('borrow_date')->nullable()->change();
            $table->date('due_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->enum('status', ['borrowed', 'returned', 'overdue'])
                  ->default('borrowed')
                  ->change();
            
            $table->date('borrow_date')->nullable(false)->change();
            $table->date('due_date')->nullable(false)->change();
        });
    }
};
