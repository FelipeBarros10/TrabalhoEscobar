@php
    $selectedBrand = old('brand_id', isset($vehicle) ? $vehicle->brand_id : '');
    $selectedModel = old('vehicle_model_id', isset($vehicle) ? $vehicle->vehicle_model_id : '');
    $selectedColor = old('color_id', isset($vehicle) ? $vehicle->color_id : '');
    $photoUrls = old('photo_urls', $additionalPhotos ?? ['']);
    if (count($photoUrls) < 2) {
        $photoUrls = array_pad($photoUrls, 2, '');
    }
@endphp

<div class="grid gap-6 md:grid-cols-2">
    <div class="space-y-6">
        <div>
            <label for="brand_id" class="block text-sm font-semibold text-slate-600">Marca</label>
            <select id="brand_id" name="brand_id" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                <option value="">Selecione</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" @selected($selectedBrand == $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="vehicle_model_id" class="block text-sm font-semibold text-slate-600">Modelo</label>
            <select id="vehicle_model_id" name="vehicle_model_id" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                <option value="">Selecione</option>
                @foreach($models as $model)
                    <option value="{{ $model->id }}" @selected($selectedModel == $model->id)>{{ $model->brand->name }} — {{ $model->name }}</option>
                @endforeach
            </select>
            <p class="mt-2 text-xs text-slate-400">Certifique-se de escolher o modelo correspondente à marca selecionada.</p>
        </div>
        <div>
            <label for="color_id" class="block text-sm font-semibold text-slate-600">Cor</label>
            <select id="color_id" name="color_id" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                <option value="">Selecione</option>
                @foreach($colors as $color)
                    <option value="{{ $color->id }}" @selected($selectedColor == $color->id)>{{ $color->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="year" class="block text-sm font-semibold text-slate-600">Ano</label>
                <input type="number" id="year" name="year" min="" value="{{ old('year', isset($vehicle) ? $vehicle->year : '') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
            </div>
            <div>
                <label for="mileage" class="block text-sm font-semibold text-slate-600">Quilometragem (km)</label>
                <input type="number" id="mileage" name="mileage" min="0" step="100" value="{{ old('mileage', isset($vehicle) ? $vehicle->mileage : '') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
            </div>
            <div>
                <label for="price" class="block text-sm font-semibold text-slate-600">Valor</label>
                <input type="number" id="price" name="price" min="0" step="0.01" value="{{ old('price', isset($vehicle) ? $vehicle->price : '') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div>
            <label for="main_image_url" class="block text-sm font-semibold text-slate-600">Foto principal (URL)</label>
            <input type="url" id="main_image_url" name="main_image_url" value="{{ old('main_image_url', isset($vehicle) ? $vehicle->main_image_url : '') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-600">Outras fotos (mínimo 2 URLs)</label>
            <div id="photoFields" class="mt-3 space-y-3">
                @foreach($photoUrls as $index => $url)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/60 px-4 py-3">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Foto {{ $index + 1 }}</span>
                        <input type="url" name="photo_urls[]" value="{{ $url }}" required class="flex-1 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                        <button type="button" class="remove-photo inline-flex items-center justify-center rounded-full border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-red-50 transition" @if($index < 2) disabled @endif>Remover</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="addPhotoField" class="mt-3 inline-flex items-center gap-2 rounded-full border border-primary-200 px-4 py-2 text-sm font-semibold text-primary-600 hover:bg-primary-50 transition">Adicionar foto</button>
            <p class="mt-2 text-xs text-slate-400">A foto principal também será exibida na galeria automaticamente.</p>
        </div>
    </div>
</div>

<div class="mt-6">
    <label for="description" class="block text-sm font-semibold text-slate-600">Descrição</label>
    <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">{{ old('description', isset($vehicle) ? $vehicle->description : '') }}</textarea>
</div>

<div class="flex items-center justify-end gap-3 mt-8">
    <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Cancelar</a>
    <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white shadow hover:bg-primary-700 transition">
        Salvar veículo
    </button>
</div>

@push('scripts')
    @once
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('photoFields');
                const addButton = document.getElementById('addPhotoField');

                addButton?.addEventListener('click', () => {
                    const index = container.children.length + 1;
                    const wrapper = document.createElement('div');
                    wrapper.className = 'flex flex-col sm:flex-row sm:items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/60 px-4 py-3';
                    wrapper.innerHTML = `
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Foto ${index}</span>
                        <input type="url" name="photo_urls[]" class="flex-1 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100" required>
                        <button type="button" class="remove-photo inline-flex items-center justify-center rounded-full border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-red-50 transition">Remover</button>
                    `;
                    container.appendChild(wrapper);
                    [...container.querySelectorAll('.remove-photo')].forEach((btn, idx) => {
                        btn.disabled = idx < 2;
                    });
                });

                container?.addEventListener('click', event => {
                    const button = event.target.closest('.remove-photo');
                    if (!button) return;
                    const fields = [...container.querySelectorAll('.remove-photo')];
                    if (fields.length <= 2) return;
                    button.closest('div').remove();
                    [...container.querySelectorAll('.remove-photo')].forEach((btn, idx) => {
                        btn.disabled = idx < 2;
                    });
                    [...container.querySelectorAll('span')].forEach((label, idx) => label.textContent = `Foto ${idx + 1}`);
                });

                [...container.querySelectorAll('.remove-photo')].forEach((btn, idx) => {
                    btn.disabled = idx < 2;
                });
            });
        </script>
    @endonce
@endpush
