
<h1 class="page-header">Admin</h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">Users table</h2>
    </div>
    <div class="panel-body">
        <a href="#" class="pull-right">Ajouter un utilisateur</a>
        <span class="fa fa-user pull-right"></span>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Job</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Franck</td>
                <td>ctelyon@hotmail.com</td>
                <td>aucun job pour l'instant</td>
                <td class="button"><button class="btn btn-info btn-sm">Edit</button><button class="btn btn-primary btn-sm">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>
<h1 class="page-header">Admin</h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">Post table</h2>
    </div>
    <div class="panel-body">
        <a href="#" class="pull-right">Ajouter un nouvel article</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Le power controler</td>
            <td>le-power-controler</td>
            <td>Lorem ipsum dolor sit amet, consectetures voluptatum.</td>
            <td class="icon"><a href="#" class="fa fa-edit"></a><a href="#" class="fa fa-trash-o"></a></td>
        </tr>
        </tbody>
    </table>
</div>
@yield('comments')