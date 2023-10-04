<?php

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('ita')->nullable();
            $table->string('en')->nullable();
            $table->string('ro')->nullable();
            $table->timestamps();
        });

        $itas = [
            'Motori',
            'Informatica',
            'Elettrodomestici',
            'Libri',
            'Giochi',
            'Sport',
            'Immobili',
            'Telefonia',
            'Arredamento',
            'Abbigliamento',
        ];

        $engs = [
            'Motors',
            'IT',
            'Electronics',
            'Books',
            'Toys',
            'Sport',
            'Properties',
            'Mobile Phones',
            'Interior Design',
            'Clothing',
        ];

        $ros = [
            'Motoare',
            'Informatica',
            'Electrodomestice',
            'Cărți',
            'Jocuri',
            'Sport',
            'Proprietăți',
            'Telefonie',
            'Design de interioare',
            'Haine',
        ];

        for ($i=0; $i < 10; $i++) { 
            $category = Category::create();
            $category->ita = $itas[$i];
            $category->en = $engs[$i];
            $category->ro = $ros[$i];
            $category->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
