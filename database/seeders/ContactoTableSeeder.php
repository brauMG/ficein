<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContactoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacto')->insert([
            'texto' => 'Placeholder',
            'numero_1' => '000-000-0000',
            'numero_2' => '',
            'numero_3' => '',
            'correo_1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel ipsum auctor, placerat lorem in, ullamcorper sapien. Integer imperdiet est ac elit elementum placerat. Integer eros mauris, tristique in magna non, tincidunt commodo massa. Phasellus scelerisque commodo pellentesque. Ut et nisi consequat metus ullamcorper commodo vitae id tortor. Nulla vestibulum velit magna, eget vehicula ipsum rutrum et. Fusce suscipit tempor ex, sit amet elementum turpis venenatis vitae. Suspendisse sapien turpis, ultricies quis efficitur et, finibus vitae tellus. Morbi ullamcorper nibh sit amet accumsan pulvinar. Sed auctor vel ex at gravida. Aenean ultrices varius est, eu ultricies magna congue et. Vestibulum nec libero ex.

Proin id tincidunt est, ut consequat ipsum. Fusce at magna a nunc euismod scelerisque ultrices rhoncus magna. Nam magna nibh, interdum eu laoreet non, gravida rutrum elit. Fusce nec massa imperdiet turpis molestie rutrum. In venenatis eros augue, eu consequat ligula maximus sed. Donec sagittis pulvinar sem, in dapibus urna scelerisque in. Fusce vel fringilla nisl, cursus hendrerit neque. Curabitur egestas sapien eu tortor pulvinar, vel vulputate nulla tristique.',
            'correo_2' => '',
            'correo_3' => '',
        ]);
    }
}
