<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'description', 'budget', 'user_id', 'title', 'category_id', 'attachments'
    ];

    protected $casts = [
        'attachments' => 'json',
    ];






    const TYPE_FIXED = 'fixed';
    const Type_HOURLY = 'hourly';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function types()
    {
        return [
            self::TYPE_FIXED => 'fixed',
            self::Type_HOURLY => 'hourly'
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function proposedFreelancers()
    {
        return $this->belongsToMany(User::class, 'proposals', 'project_id', 'freelancer_id')->withPivot([
            'description', 'cost', 'duration', 'duration_unit', 'status'
        ]);
    }


    public function contractedFreelancers()
    {
        return $this->belongsToMany(User::class, 'contracts', 'project_id', 'freelancer_id')->withPivot([
            'cost', 'type', 'start_on', 'end_on', 'completed_on', 'hours', 'status'
        ]);
    }
    public function syncTags($tags)
    {
        $tags_id = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::firstOrCreate([
                'slug' => Str::slug($tag_name)
            ], [
                'name' => trim($tag_name)
            ]);

            $tags_id[] = $tag->id;
        }

        $this->tags()->sync($tags_id);
    }

    public static function booted()
    {
        static::addGlobalScope('status', function (EloquentBuilder $builder) {
            $builder->where('status', 'open');
        });
    }

    public function scopeFilter(EloquentBuilder $builder, $filters=[])
    {
        $filters = array_merge([
            'type' => null,
            'status' => null,
            'budget_min' => null,
            'budget_max' => null
        ], $filters);

        $builder->when($filters['type'], function ($builder, $value) {
            $builder->where('type', $value);
        });
        $builder->when($filters['status'], function ($builder, $value) {
            $builder->where('status', $value);
        });
        $builder->when($filters['budget_min'], function ($builder, $value) {
            $builder->where('budget', '>=', $value);
        });
        $builder->when($filters['budget_max'], function ($builder, $value) {
            $builder->where('budget', '<=', $value);
        });
    }
}
