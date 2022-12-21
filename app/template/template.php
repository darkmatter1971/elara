<?php
namespace Template\Engine;

class TemplateEngine
{
    private $data = [];
    private $partial_buffer;
    private $template;

    public function __construct($_path = null)
    {
        if (!empty($_path))
        {
            if (file_exists($_path))
            {
                $this->template = file_get_contents($_path);
            }
            else
            {
                throw new \Exception('The specified template file does not exist.');
            }
        }
    }

    public function assign_value($search_string, $replace_string, $default_value = null)
    {
        if (!empty($search_string))
        {
            $search_string = strtoupper($search_string);

            if ($default_value !== null)
            {
                $this->template = str_replace("{" . $search_string . "}", $default_value, $this->template);
            }

            $this->data[$search_string] = htmlspecialchars($replace_string);
            $this->template = str_replace("{" . $search_string . "}", $replace_string, $this->template);
        }
    }

    public function render_partial($_search_string, $_path, $assigned_values = [])
    {
        if (!empty($_search_string))
        {
            if (file_exists($_path))
            {
                $this->partial_buffer = file_get_contents($_path);

                if (count($assigned_values) > 0)
                {
                    foreach ($assigned_values as $key => $value)
                    {
                        $this->partial_buffer = str_replace("{" . strtoupper($key) . "}", htmlspecialchars($value) , $this->partial_buffer);
                    }
                    $this->template = str_replace("[" . strtoupper($_search_string) . "]", $this->partial_buffer, $this->template);
                }
                else
                {
                    $this->template = str_replace("[" . strtoupper($_search_string) . "]", $this->partial_buffer, $this->template);
                }
            }
            else
            {
                throw new \Exception('The specified partial file does not exist.');
            }
        }
    }

    public function render_partials(array $partials)
    {
        foreach ($partials as $search_string => $path)
        {
            $this->render_partial($search_string, $path);
        }
    }

    public function render()
    {
        return $this->template;
    }
}

// namespace Template\Engine;
// class TemplateEngine
// {
//     private $data = [];
//     private $partial_buffer;
//     private $template;
//     public function __construct($_path = null)
//     {
//         if (!empty($_path)) {
//             if (file_exists($_path)) {
//                 $this->template = file_get_contents($_path);
//             } else {
//                 throw new \Exception('The specified template file does not exist.');
//             }
//         }
//     }
//     public function assign_value($search_string, $replace_string)
//     {
//         if (!empty($search_string)) {
//             $this->data[strtoupper($search_string)] = htmlspecialchars($replace_string);
//         }
//     }
//     public function render_partial($_search_string, $_path, $assigned_values = [])
//     {
//         if (!empty($_search_string)) {
//             if (file_exists($_path)) {
//                 $this->partial_buffer = file_get_contents($_path);
//                 if (count($assigned_values) > 0) {
//                     foreach ($assigned_values as $key => $value) {
//                         $this->partial_buffer = str_replace(
//                             "{" . strtoupper($key) . "}",
//                             htmlspecialchars($value),
//                             $this->partial_buffer
//                         );
//                     }
//                     $this->template = str_replace(
//                         "[" . strtoupper($_search_string) . "]",
//                         $this->partial_buffer,
//                         $this->template
//                     );
//                 } else {
//                     $this->template = str_replace(
//                         "[" . strtoupper($_search_string) . "]",
//                         $this->partial_buffer,
//                         $this->template
//                     );
//                 }
//             } else {
//                 throw new \Exception('The specified partial file does not exist.');
//             }
//         }
//     }
//     public function render()
//     {
//         if (count($this->data) > 0) {
//             foreach ($this->data as $key => $value) {
//                 $this->template = str_replace("{" . $key . "}", $value, $this->template);
//             }
//         }
//         return $this->template;
//     }
// }


/*
Yes, you can add if-else condition and loop constructs to the code in several ways. One way to do this would be to use regular PHP if-else and loop statements within the render() method where you can manipulate the $this->template variable based on certain conditions and loop through data sets.

Here is an example of how you could add an if-else condition and a for loop to the render() method:
*/

// public function render()
// {
//     if (count($this->data) > 0) {
//         foreach ($this->data as $key => $value) {
//             $this->template = str_replace("{" . $key . "}", $value, $this->template);
//         }
//     }
//     // Check if a certain variable is set and has a specific value
//     // and modify the template accordingly
//     if (isset($this->data['SOME_VARIABLE']) && $this->data['SOME_VARIABLE'] == 'some value') {
//         $this->template = str_replace('{SOME_VARIABLE}', 'Replaced content', $this->template);
//     } else {
//         $this->template = str_replace('{SOME_VARIABLE}', 'Default content', $this->template);
//     }
//     // Loop through an array of data and modify the template
//     $items = ['item 1', 'item 2', 'item 3'];
//     $items_list = '';
//     foreach ($items as $item) {
//         $items_list .= "<li>{$item}</li>";
//     }
//     $this->template = str_replace('{ITEMS_LIST}', $items_list, $this->template);
//     return $this->template;
// }
/*
Note that the above code is just an example to illustrate how you can add if-else condition and loop constructs to the render() method. You may need to modify the code and adapt it to your specific use case.
*/

/*
It is possible to add support for conditional statements and loops to the code you provided. However, doing so would require modifying the code significantly.

Here is an example of how you could add support for if statements to the render() method:
*/

// public function render()
// {
//     $template = $this->template;
//     // Use a regular expression to find {IF <variable>} and {ENDIF} tags in the template
//     preg_match_all('/\{IF ([^}]+)\}(.*)\{ENDIF\}/Us', $template, $matches, PREG_SET_ORDER);
//     foreach ($matches as $match) {
//         // Extract the variable name and the contents of the {IF} block
//         list(, $variable, $block) = $match;
//         // Check if the variable exists and is truthy
//         if (isset($this->data[strtoupper($variable)]) && $this->data[strtoupper($variable)]) {
//             // Replace the {IF} block with the contents of the block
//             $template = str_replace($match[0], $block, $template);
//         } else {
//             // Replace the {IF} block with an empty string
//             $template = str_replace($match[0], '', $template);
//         }
//     }
//     // Use a regular expression to find {ELSE} tags in the template
//     preg_match_all('/\{ELSE\}(.*)/Us', $template, $matches, PREG_SET_ORDER);
//     foreach ($matches as $match) {
//         // Extract the contents of the {ELSE} block
//         list(, $block) = $match;
//         // Replace the {ELSE} block with an empty string
//         $template = str_replace($match[0], '', $template);
//     }
//     // Replace all remaining {VAR} placeholders with the corresponding values from the data array
//     if (count($this->data) > 0) {
//         foreach ($this->data as $key => $value) {
//             $template = str_replace("{" . $key . "}", $value, $template);
//         }
//     }
//     return $template;
// }


/*
This implementation allows you to use {IF <variable>}...{ENDIF} and {ELSE}... blocks in your templates. Any text or placeholders inside the {IF} block will be rendered only if the specified variable exists and is truthy. Otherwise, the {IF} block will be removed from the template. The {ELSE} block, if present, will be removed regardless of the value of the variable.

Similarly, you could add support for FOR loops by modifying the render() method as follows:
*/

// public function render()
// {
//     $template = $this->template;
//     // Use a regular expression to find {FOR <variable> IN <array>} and {ENDFOR} tags in the template
//     preg_match_all('/\{FOR ([^ ]+) IN ([^}]+)\}(.*)\{ENDFOR\}/Us', $template, $matches, PREG_SET_ORDER);
//     foreach ($matches as $match) {
//         // Extract the loop variable

