<x-app-layout>
<h1>タスク追加</h1> 

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li style="color:red;">{{$error}}</li>
    @endforeach
</ul>
@endif

<form action="{{route('tasks.store')}}" method="post">
    @csrf
    <div>
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title" 
        placeholder="タイトルを入力してください" 
        value="{{old('title')}}">
    </div>
    <div>
        <label for="content">内容</label>
        <textarea id="content" name="content" placeholder="内容を入力してください">{{old('content')}}</textarea>
    </div>

    <div>
        <label for="status">ステータス</label>
        <select name="status" id="status">
            <option value="未着手">未着手</option>
            <option value="進行中">進行中</option>
            <option value="完了">完了</option>
        </select>
    </div>

    <button type="submit">保存</button>
</form>

</x-app-layout>