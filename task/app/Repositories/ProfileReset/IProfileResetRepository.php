<?php

namespace App\Repositories\ProfileReset;

use App\Models\ProfileReset;
use Illuminate\Database\Eloquent\Builder;

interface IProfileResetRepository
{
    public function create(array $data): ProfileReset;
    public function update(ProfileReset|Builder $profileReset, array $updateData): ProfileReset|Builder;
}
