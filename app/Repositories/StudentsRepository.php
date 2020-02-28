<?php


namespace App\Repositories;


use App\Models\Student;
use App\Models\StudentsTicketTypesLessonsLeft;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class StudentsRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Student::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'phone',
            'vk_profile_link', 'vk_profile_id',
            'facebook_profile_link', 'facebook_profile_id',
            'instagram_profile_link', 'instagram_profile_id',
            'photo_link', 'extra_info', 'push_token', 'barcode_id'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }

    public function getStudentByBarcodeId($barcodeId)
    {
        $result = $this->startConditions()->newQuery()->select()
            ->where('barcode_id', '=', $barcodeId)
            ->with('lessonsLeft')
            ->get();
        return $result->first();

    }

    function storeItem($data): Model
    {
        if ($data['vk_profile_link'] != null) {
            $link = $data['vk_profile_link'];
            $data['vk_profile_id'] = $this->getVkId($link);
        }
        $item = $this->startConditions()::create($data);
        return $item;
    }


    function updateItem($data, $id)
    {
        \Log::debug('BaseRepository updating');
        $group = $this->getItemById($id);
        $group->fill($data);
        $isVkLinkChanged = array_key_exists('vk_profile_link', $group->getDirty());
        if ($isVkLinkChanged) {
            $link = $group->getDirty()['vk_profile_link'];
            $group->vk_profile_id = $this->getVkId($link);
        }
        $result = $group->save();
        return $result;
    }

    private function getVkId($link)
    {
        $username = str_replace('https://vk.com/', '', $link);
        $accessToken = env('VK_ACCESS_TOKEN');
        $url = "https://api.vk.com/method/users.get?access_token={$accessToken}&v=5.69&user_ids={$username}";
        $idAnswer = json_decode(file_get_contents($url));
        if (property_exists($idAnswer, 'response')) {
            $vkId = $idAnswer->response[0]->id;
        } else {
            $vkId = null;
        }
        return $vkId;
    }

    function createStudentByEmail($email): int {
        $newStudent = $this->createItem();
        $newStudent->name = $email;
        $maxBarcodeId = $this->startConditions()->newQuery()->select('barcode_id')->max('barcode_id');
        $maxBarcodeId++;
        $newStudent->barcode_id = $maxBarcodeId;
        $newStudent->save();
        return $maxBarcodeId;
    }


}
