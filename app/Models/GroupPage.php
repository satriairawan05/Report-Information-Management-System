<?php

namespace App\Models;

use App\Models\Page;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupPage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_pages';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'gp_id';

    /**
     * Get the group_pages associated with the group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class,'group_id','group_id');
    }

    /**
     * Get the group_pages associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id','page_id');
    }
}
