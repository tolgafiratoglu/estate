<?php

use Illuminate\Database\Seeder;

use App\Repositories\SystemMediaRepository;

class SystemMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SystemMediaRepository $systemMediaRepository)
    {

        $defaultSystemMedia = config('settings.system_media');

        if(sizeof($defaultSystemMedia) > 0)
        {
            foreach($defaultSystemMedia AS $metaKey=>$metaValue)
            {
                $metaValueCount = $systemMediaRepository->findWhere(["meta_key"=>$metaKey])->count();

                if($metaValueCount == 0)
                {
                    $systemMediaRepository->create(['meta_key'=>$metaKey, 'media'=>$metaValue]);
                }
            }
        }

    }
}
