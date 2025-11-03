<div class="space-y-6">
    <div>
        <label for="brand_id" class="block text-sm font-semibold text-slate-600">Marca</label>
        <select id="brand_id" name="brand_id" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
            <option value="">Selecione uma marca</option>
            @foreach($brands as $id => $name)
                <option value="{{ $id }}" @selected(old('brand_id', $model->brand_id ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-600">Nome do modelo</label>
        <input type="text" id="name" name="name" value="{{ old('name', $model->name ?? '') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
    </div>
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.models.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Cancelar</a>
        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white shadow hover:bg-primary-700 transition">
            Salvar
        </button>
    </div>
</div>
