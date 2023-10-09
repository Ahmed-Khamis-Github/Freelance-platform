<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css') ?>">
</head>

<body>

    <div class="container">
        <h1 class="mb-3"><?php echo $title ?? '' ?></h1>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>slug</th>
                    <th>parent_id</th>
                    <th>created_at</th>
                </tr>
            </thead>

            <tbody>
                     <tr>

                        <td><?php echo  $category->id ?></td>
                        <td><a href="categories/<?php echo $category->id ?>"><?php echo $category->name ?></a></td>
                        <td><?php echo $category->slug ?></td>
                        <td><?php echo $category->parent_id ?></td>
                        <td><?php echo $category->created_at ?></td>
                    </tr>
             </tbody>
        </table>
    </div>
    </div>
</body>

</html>