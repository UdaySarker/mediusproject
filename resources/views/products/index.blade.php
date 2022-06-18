@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>

    <div class="card">
        <form action="/search" method="get" class="card-header">
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                </div>
                <div class="col-md-2">
                    <select name="variant" id="" class="js-example-basic-single form-control">
                        @foreach ($variants as $variantName)
                            <optgroup label="{{ $variantName->title }}">
                                @foreach ($variantLists as $variantList)
                                    @if ($variantName->id == $variantList->variant_id)
                                        <option value="">
                                            {{ $variantList->variant }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach

                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="price_from" aria-label="First name" placeholder="From"
                            class="form-control">
                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Variant</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }} <br> Created at : @php
                                    $created = Carbon\Carbon::parse($product->created_at);
                                    $now = Carbon\Carbon::now();
                                    echo $created->diffInDays($now);
                                @endphp days ago</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    @foreach ($product->product_variant_price as $productPrice)
                                        <dl class="row mb-0" style="height: 80px; overflow:hidden" id="variant">
                                            <dt class="col-sm-3 pb-0">
                                                {{-- SM/ Red/ V-Nick --}}
                                                {{ $productPrice->variantTwo->variant }}/{{ $productPrice->variantOne->variant }}/{{ $productPrice->variantTwo->variant ?: '' }}
                                            </dt>
                                            <dd class="col-sm-9">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-4 pb-0">Price
                                                        :{{ number_format($productPrice->price, 2) }}</dt>
                                                    <dd class="col-sm-8 pb-0">InStock
                                                        :{{ number_format($productPrice->stock, 2) }}
                                                    </dd>
                                                </dl>
                                            </dd>
                                        </dl>
                                    @endforeach
                                    <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show
                                        more</button>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <p>Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} out of
                        {{ $products->total() }}</p>
                </div>
                <div class="col-md-2">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
