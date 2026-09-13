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
        if (Schema::hasTable('pesanans')) {
            Schema::table('pesanans', function (Blueprint $table) {
                if (!Schema::hasColumn('pesanans', 'detail_items')) {
                    $table->longText('detail_items')->nullable();
                }
                if (!Schema::hasColumn('pesanans', 'catatan_finishing')) {
                    $table->text('catatan_finishing')->nullable();
                }
                if (!Schema::hasColumn('pesanans', 'file_desain')) {
                    $table->string('file_desain')->nullable();
                }
                if (!Schema::hasColumn('pesanans', 'status_pembayaran')) {
                    $table->string('status_pembayaran')->default('Belum Lunas');
                }
                if (!Schema::hasColumn('pesanans', 'sisa_bayar')) {
                    $table->bigInteger('sisa_bayar')->default(0);
                }
            });
        }

        if (Schema::hasTable('pembayarans')) {
            Schema::table('pembayarans', function (Blueprint $table) {
                if (!Schema::hasColumn('pembayarans', 'uang_diterima')) {
                    $table->bigInteger('uang_diterima')->nullable();
                }
                if (!Schema::hasColumn('pembayarans', 'kembalian')) {
                    $table->bigInteger('kembalian')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pesanans')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $cols = [];
                if (Schema::hasColumn('pesanans', 'detail_items')) $cols[] = 'detail_items';
                if (Schema::hasColumn('pesanans', 'catatan_finishing')) $cols[] = 'catatan_finishing';
                if (Schema::hasColumn('pesanans', 'file_desain')) $cols[] = 'file_desain';
                if (Schema::hasColumn('pesanans', 'status_pembayaran')) $cols[] = 'status_pembayaran';
                if (Schema::hasColumn('pesanans', 'sisa_bayar')) $cols[] = 'sisa_bayar';
                if (!empty($cols)) {
                    $table->dropColumn($cols);
                }
            });
        }

        if (Schema::hasTable('pembayarans')) {
            Schema::table('pembayarans', function (Blueprint $table) {
                $cols = [];
                if (Schema::hasColumn('pembayarans', 'uang_diterima')) $cols[] = 'uang_diterima';
                if (Schema::hasColumn('pembayarans', 'kembalian')) $cols[] = 'kembalian';
                if (!empty($cols)) {
                    $table->dropColumn($cols);
                }
            });
        }
    }
};
