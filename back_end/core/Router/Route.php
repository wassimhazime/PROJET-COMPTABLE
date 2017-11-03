<?php



namespace core\Router;


class Route {

    private $path;
    private $callable;
    private $variable_match = [];
    private $param_with = [];

    function __construct(string $path, callable $callable) {

        $this->path = trim($path, "/");
        ;
        $this->callable = $callable;
    }

    public function with($param, $regex): self {
        $regex= str_replace("(", "(?", $regex);//pour ne creier (
        $this->param_with[$param] = "($regex)";
        return $this;
    }

    private function replace_callback($paramPath) {
        if (isset($this->param_with[$paramPath[1]])) {
            return $this->param_with[$paramPath[1]];
        };

        return '([^/]+)';
    }

    public function match($url): bool {
        $url = trim($url, "/");

        
        //si il ya parame
        // exemple/:hh TO   exemple/([^/]+)
        $path = preg_replace_callback('#{([a-zA-Z0-9]+)}#',
                [$this, 'replace_callback'],
                $this->path);

        $regex = "#^$path$#i";

       
        if (!preg_match($regex, $url, $match)) {
            return false;
        }
        array_shift($match);
        $this->variable_match = $match;
          return true;
    }

    public function call() {
        call_user_func_array($this->callable, $this->variable_match);
    }

}
