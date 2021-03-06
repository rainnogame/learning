<?


/**
 * @param $root_path
 * @param $dir
 * @return bool
 */
function isValidDir($root_path, $dir)
{
    return is_dir($root_path . '/' . $dir) and $dir != '.' and $dir != '..';
}

function delTree($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

/**
 * @param $root_path
 * @param $file_name
 * @return bool
 */
function isValidFile($root_path, $file_name)
{
    return is_file($root_path . '/' . $file_name) and $file_name != '.' and $file_name != '..';
}

/**
 * @param $root_path
 * @return mixed
 */
function getLastName($root_path)
{
    $dirPathArray = explode('/', $root_path);

    $last_name = $dirPathArray[count($dirPathArray) - 1];
    return $last_name;
}

function walkDirs($root_path)
{
    $dirs = scandir($root_path);


    $trimRootPath = trim($root_path, './');

    $last_name = getLastName($root_path);

    @mkdir(__DIR__ . '/../table_of_content/' . $trimRootPath);

    $fileName = __DIR__ . '/../table_of_content/' . $trimRootPath . '/' . $last_name . '.md';
    file_put_contents($fileName, '');


    $dircount = 0;
    $filecount = 0;

    foreach ($dirs as $dir) {
        if (isValidDir($root_path, $dir)) {
            $dircount++;

            if ($dircount == 1) {
                file_put_contents($fileName, '#Категории' . "<br/>\n", FILE_APPEND);
            }

            $resString = "[$dir]" . str_replace(' ', '%20', "(https://github.com/rainnogame/learning/blob/master/table_of_content/" . $trimRootPath . '/' . $dir . '/' . $dir . ".md)<br/>\n");
            file_put_contents($fileName, $resString, FILE_APPEND);


            walkDirs($root_path . '/' . $dir);
        } elseif (isValidFile($root_path, $dir)) {
            $filecount++;
            if ($filecount == 1) {
                file_put_contents($fileName, '#Статьи' . "<br/>\n", FILE_APPEND);
            }
            $f = fopen($root_path . '/' . $dir, 'r');
            $title = str_replace(["\n", '#'], '', fgets($f));

            $resString = "[$title]" . str_replace(' ', '%20', "(https://github.com/rainnogame/learning/blob/master/" . $trimRootPath . '/' . $dir . ")<br/>\n");
            file_put_contents($fileName, $resString, FILE_APPEND);
        }
    }
}


$last_name = 'readme';
$root_path = '../docs';

delTree('../table_of_content/docs');
walkDirs($root_path);

rename('../table_of_content/docs/docs.md', '../readme.md');

shell_exec('git add ../.');
shell_exec('git commit -m "commit"');
shell_exec('git pull');
shell_exec('git push --all');