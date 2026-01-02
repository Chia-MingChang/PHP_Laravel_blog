<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">
            @if(Auth::check() && Auth::user()->usertype == 'admin')
            Admin Dashboard
            @else
            User Dashboard
            @endif
        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- display single post -->
                    <div class="p-6 text-gray-900" style="text-align:center; border:1px solid blue;">
                        @if (session('status'))
                        <div style="background-color:lightgreen" class="alert alert-success">
                            {{session('status')}}
                        </div>
                        @endif

                        <!-- single post -->
                        <form action="{{route('admin.postupdate',$post->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="title" value="{{$post->title}}"><br><br><br>
                            <textarea style="width:400px; height:400px;" name="description" id="">{{$post->description}}</textarea><br><br><br>
                            <label style="background-color:lightgreen; ">Old Image</label>
                            <img src="{{asset('img/'.$post->image)}}" style="width: 100px;height:100px; margin-left:400px; margin-bottom: 10px;" alt="{{$post->image}}">
                            <label style="background-color: lightgreen;">Upload new Image</label>
                            <input type="file" name="image"> <br><br><br>
                            <img src="{{asset('img/'.$post->image)}}" alt="{{$post->image}}">
                            <input style="border: 1px solid blue; text-align:center; padding:10px" type="submit" name="submit" value="update post">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>