<div class="dropdown d-inline-block">
    <button class="btn btn-sm btn-soft-info waves-effect waves-light dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-more-2-fill align-middle"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        @foreach ($actions as $key => $item)
            @if ($key == 'Detail')
                <li>
                    <a href="{{ $item }}" class="dropdown-item">
                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> {{ $key }}
                    </a>
                </li>
            
            @elseif ($key == 'Edit')
                <li>
                    <a href="{{ $item }}" class="dropdown-item edit-item-btn">
                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ $key }}
                    </a>
                </li>

            @elseif ($key == 'Move')
                <li>
                    <a href="{{ $item }}" class="dropdown-item edit-item-btn">
                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> {{ $key }}
                    </a>
                </li>
            @elseif ($key == 'Delete')
                <li class="dropdown-divider"></li>
                <li>{!! $deleteForm !!}</li>
            @else
                
            @endif
        @endforeach
    </ul>

    {{-- <ul class="dropdown-menu dropdown-menu-end show" 
        data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-25px, 30.5px, 0px);">
        <li>
            <a class="dropdown-item" href="apps-ecommerce-product-details.html">
                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="apps-ecommerce-add-product.html">
                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
            </a>
        </li>

        <li class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item" href="#!">
                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
            </a>
        </li>
    </ul> --}}
</div>