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
                file_put_contents($fileName, '#Категории' . "\n", FILE_APPEND);
            }

            $resString = "[$dir]" . str_replace(' ', '%20', "(https://github.com/rainnogame/learning/blob/master/table_of_content/" . $trimRootPath . '/' . $dir . '/' . $dir . ".md)\n");;
            file_put_contents($fileName, $resString, FILE_APPEND);


            walkDirs($root_path . '/' . $dir);
        } elseif (isValidFile($root_path, $dir)) {
            $filecount++;
            if ($filecount == 1) {
                file_put_contents($fileName, '#Статьи' . "\n", FILE_APPEND);
            }
            $f = fopen($root_path . '/' . $dir, 'r');
            $title = str_replace(["\n", '#'], '', fgets($f));

            $resString = "[$title]" . str_replace(' ', '%20', "(https://github.com/rainnogame/learning/blob/master/" . $trimRootPath . '/' . $dir . ")\n");;
            file_put_contents($fileName, $resString, FILE_APPEND);
        }
    }
}


$last_name = 'readme';
$root_path = '../docs';
walkDirs($root_path);
shell_exec('git add ../.');
shell_exec('git commit -m "commit"');
shell_exec('git pull');
shell_exec('git push --all');