<div class="row">
  <div class="col-12 col-md-8">
    <div class="form-horizontal">
      {{ __('catalog::product.gallery') }}
      @gallery(['id' => 'gallery-component-1', 'name' => 'gallery'])
      <br/>
      @input(['name' => 'name', 'label' => __('slider::slider-item.name')])
      @input(['name' => 'link', 'label' => __('slider::slider-item.link')])
      @textarea(['name' => 'description', 'label' => __('slider::slider-item.description')])
    </div>
  </div>
  <div class="col-12 col-md-4">
    @translatable

    @checkbox(['name' => 'is_active', 'label' => __('slider::slider-item.is_active')])
    @input(['name' => 'sort_order', 'label' => __('slider::slider-item.sort_order')])
  </div>
</div>