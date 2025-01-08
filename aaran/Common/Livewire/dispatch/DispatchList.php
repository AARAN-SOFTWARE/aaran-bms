<?php

namespace Aaran\Common\Livewire\dispatch;

use Aaran\Common\Models\Category;
use Aaran\Common\Models\City;
use Aaran\Common\Models\Colour;
use Aaran\Common\Models\Country;
use Aaran\Common\Models\Despatch;
use Aaran\Common\Models\Hsncode;
use Aaran\Common\Models\Pincode;
use Aaran\Common\Models\Size;
use App\Livewire\Trait\CommonTrait;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DispatchList extends Component
{
    use CommonTrait;

    #[Validate]
    public string $vname = '';
    public string $vdate = '';
    public bool $active_id = true;

    #region[Validation]
    public function rules(): array
    {
        return [
            'vname' => 'required:despatches,vname',
        ];
    }

    public function messages(): array
    {
        return [
            'vname.required' => 'The :attribute are missing.',
            'vname.unique' => 'The :attribute is already created.',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'vname' => 'name',
        ];
    }

    #endregion[Validation]

    #region[save]
    public function getSave(): void
    {
        $this->validate();

        if ($this->vid == "") {
            Despatch::create([
                'vname' => Str::ucfirst($this->vname),
                'vdate' => $this->vdate,
                'active_id' => $this->active_id,
            ]);
            $message = "Saved";

        } else {
            $obj = Despatch::find($this->vid);
            $obj->vname = Str::ucfirst($this->vname);
            $obj->vdate = $this->vdate;
            $obj->active_id = $this->active_id;
            $obj->save();
            $message = "Updated";
        }

        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->vid = '';
        $this->vname = '';
        $this->vdate = '';
        $this->active_id = '1';
        $this->searches = '';
    }
    #endregion[Clear Fields]

    #region[obj]
    public function getObj($id): void
    {
        if ($id) {
            $obj = Despatch::find($id);
            $this->vid = $obj->id;
            $this->vname = $obj->vname;
            $this->vdate = $obj->vdate;
            $this->active_id = $obj->active_id;
        }
    }
    #endregion

    #region[list]
    public function getList()
    {
        return Size::search($this->searches)
            ->where('active_id', '=', $this->activeRecord)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('common::dispatch.dispatch-list')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}