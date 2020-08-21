<?php


namespace App\Services;


use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UploadImageUser
{
    private $userRepository;

    public function __construct(UserRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function execute($files, $userId)
    {
        if (!$files) return true;

        $user = $this->userRepository->find($userId);
        try {
            DB::beginTransaction();
            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->saveImage($file, $user);
                }
            } else {

            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(json_encode($e));

            return false;
        }
    }

    private function saveImage($file, $user)
    {
        try{
            $fileName = $file->store("public/images/$user->id");
            $user->images()->create(['url' => substr($fileName, 7)]);

            return true;
        } catch (\Exception $e) {
            return throwException($e);
        }
    }
}
