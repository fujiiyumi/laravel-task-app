<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2>
                タスク一覧
            </h2>

            <a href="{{ route('tasks.create') }}">
                ＋新規登録
            </a>
        </div>

    </x-slot>

    <form action="{{route('tasks.index')}}" method="get">
        <input type="text" name="keyword" value="{{request('keyword')}}" placeholder="タイトル検索">
        <select name="status">
            <option value="">すべて</option>
            <option value="未着手" @selected(request('status')==='未着手' )>未着手</option>
            <option value="進行中" @selected(request('status')==='進行中' )>進行中</option>
            <option value="完了" @selected(request('status')==='完了' )>完了</option>
        </select>
        <select name="sort">
            <option value="">並び替え</option>
            <option value="desc" @selected(request('sort')==='desc' )>新しい順</option>
            <option value="asc" @selected(request('sort')==='asc' )>古い順</option>
        </select>
        <button type="submit">検索</button>
    </form>


    <table>
        <thead>
            <tr>
                <th>タイトル</th>
                <th>内容</th>
                <th>ステータス</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->content }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}">
                        編集
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('本当に削除しますか?')">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$tasks->links()}}

</x-app-layout>