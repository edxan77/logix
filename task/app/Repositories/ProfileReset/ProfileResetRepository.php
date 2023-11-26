<?php

namespace App\Repositories\ProfileReset;

use App\Models\ProfileReset;
use Illuminate\Database\Eloquent\Builder;

class ProfileResetRepository implements IProfileResetRepository
{

    public function create(array $data): ProfileReset
    {
        $profileReset = new ProfileReset($data);
        $profileReset->save();

        return $profileReset;
    }

    public function update(ProfileReset|Builder $profileReset, array $updateData): ProfileReset|Builder
    {
        $profileReset->update($updateData);

        return $profileReset;
    }
}
