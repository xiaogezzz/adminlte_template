<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    protected $fillable = [
        'parent_id',
        'order',
        'title',
        'icon',
        'uri',
        'permission',
    ];

    protected $parentColumn = 'parent_id';

    protected $titleColumn = 'title';

    protected $orderColumn = 'order';

    public function subMenus()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function allNodes()
    {
        $orderColumn = \DB::getQueryGrammar()->wrap($this->orderColumn);
        $byOrder = $orderColumn . ' = 0,' . $orderColumn;

        $self = new static();

        return $self->orderByRaw($byOrder)->get()->toArray();
    }

    /**
     * Get options for Select field in form.
     *
     * @param string $rootText
     *
     * @return array
     */
    public static function selectOptions($rootText = 'ROOT')
    {
        $options = (new static())->buildSelectOptions();

        return collect($options)->prepend($rootText, 0)->all();
    }

    /**
     * Build options of select field in form.
     *
     * @param array $nodes
     * @param int $parentId
     * @param string $prefix
     * @param string $space
     *
     * @return array
     */
    protected function buildSelectOptions(array $nodes = [], $parentId = 0, $prefix = '', $space = '&nbsp;')
    {
        $prefix = $prefix ?: '┝' . $space;

        $options = [];

        if (empty($nodes)) {
            $nodes = $this->allNodes();
        }

        foreach ($nodes as $index => $node) {
            if ($node[$this->parentColumn] == $parentId) {
                $node[$this->titleColumn] = $prefix . $space . $node[$this->titleColumn];

                $childrenPrefix = str_replace('┝', str_repeat($space, 6), $prefix) . '┝' . str_replace(['┝', $space], '', $prefix);

                $children = $this->buildSelectOptions($nodes, $node[$this->getKeyName()], $childrenPrefix);

                $options[$node[$this->getKeyName()]] = $node[$this->titleColumn];

                if ($children) {
                    $options += $children;
                }
            }
        }

        return $options;
    }

    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed $parameters
     * @param bool $secure
     *
     * @return string
     */
    function adminUrl($path = '', $parameters = [], $secure = null)
    {
        if (\URL::isValidUrl($path)) {
            return $path;
        }

        $secure = $secure ?: (config('admin.https') || config('admin.secure'));

        return url(admin_base_path($path), $parameters, $secure);
    }
}
