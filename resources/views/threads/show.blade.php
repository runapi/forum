@extends('layouts.app')

@section('content')
    <thread-view :initial-Replies-Count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                            <span class="flex">
                            <a href="{{route('profile', $thread->creator)}}">{{ $thread->creator->name }}</a> posted:
                                {{ $thread->title }}
                            </span>
                                @can('update', $thread)
                                    <form method="POST" action="{{$thread->path()}}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-link" type="submit">Delete Thread</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>

                    <replies @removed="repliesCount--" @added="repliesCount++"></replies>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>This thread was published {{ $thread->created_at->diffForHumans() }}
                                by <a href="#">{{ $thread->creator->name }}</a> , and currently has
                                <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count )}}.
                            </p>
                            <p>
                                <subscribe-button :active="{{ json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
