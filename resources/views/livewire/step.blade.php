<div>
    <div class="flex justify-center pb-4 px-4">
        <h2 class="text-lg font-semibold">Add step</h2>
        <span wire:click="increment" class="fas fa-plus px-2 py-1 align-bottom cursor-pointer" />
    </div>

    @foreach($steps as $step)
        <div wire:key="{{$step}}" class="flex justify-center py-1">
            <input type="text" name="step[]" class="py-1 px-2 border rounded" placeholder="{{'Step '.($step+1)}}" />
            <span wire:click="remove({{$step}})" class="fa fa-trash pt-2 pl-2 text-red-400"></span>
        </div>
    @endforeach
</div>
