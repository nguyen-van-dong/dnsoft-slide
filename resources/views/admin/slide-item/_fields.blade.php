<div class="row">
  <div class="col-12 col-md-8">
    <div class="form-horizontal">
      {{ __('Image') }}
      @media(['name' => 'image', 'id' => 'image-component-1', 'show_button' => true, 'label' => 'Upload image'])
      <br/>
      @input(['name' => 'name', 'label' => __('slide::slide-item.name')])
      @input(['name' => 'link', 'label' => __('slide::slide-item.link')])
      @textarea(['name' => 'description', 'label' => __('slide::slide-item.description')])
    </div>
  </div>
  <div class="col-12 col-md-4">
    @translatable

    @checkbox(['name' => 'is_active', 'label' => __('slide::slide-item.is_active')])
    @input(['name' => 'sort_order', 'label' => __('slide::slide-item.sort_order')])
  </div>
</div>