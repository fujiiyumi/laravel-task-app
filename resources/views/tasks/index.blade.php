<x-app-layout>

<a href="{{route('tasks.create')}}">新規登録</a>
<br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>内容</th>
        <th>編集</th>
    </tr>
    @foreach($tasks as $task)
    <tr>
        <td>{{$task->id}}</td>
        <td>{{$task->title}}</td>
        <td>{{$task->content}}</td>
        <td>
            <a href="{{route('tasks.edit',$task->id)}}">編集</a>
            <form action="{{route('tasks.destroy',$task->id)}}" method="post" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</x-app-layout>