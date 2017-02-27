#!/bin/bash

for i in `ls tab*gif` ; do
        echo $i

        #convert -geometry 100%x150%! $i ../$i

        # green
        #convert -geometry 100%x150%! -channel rgb -recolor '0,0,1,0,1,0,1,0,0' $i ../$i

        # gray
        convert -geometry 100%x150%! -modulate 100,0,100 $i ../$i


done

