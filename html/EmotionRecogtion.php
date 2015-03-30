<?php
	function listTargetFiles($path, $userId)
	{
		$targetFiles = array();

		if($dir = opendir($path))
		{
    		while(($file = readdir($dir)) !== false)
			{
				if(strpos($file, $userId) === 0 && $file != "." && $file != "..")
				{
					$targetFiles[] = "$path/$file";
					$test = "$path/$file";
					//print "$test\n";
				}
			}

		}

		closedir($dir);
		return $targetFiles;
	}

	function readKeystrokeData($path)
	{
		$contents = array();
		$fp = fopen($path, 'r');

		while($line = fgets($fp))
		{
			str_replace(array("\r\n","\n","\r"), '', $line);
			$contents[] = $line;
		}

		return $contents;
	}

	function getInputDelRatio($contents, $backSpaceId)
	{
		$bsCount = 0;

		for($i=0;$i<count($contents);$i++)
		{
			$elements = split(",", $contents[$i]);
			
			if($elements[0] === $backSpaceId)
			{
				$bsCount++;
			}
		}

		return (double)$bsCount / (double)(count($contents));
	}

	function getRhythm4PC($rhythmData)
	{
		$rhythm = array();
		$pretime = 0;
		$time = 0;
		$status = array();

		for($i=0;$i<count($rhythmData);$i++)
		{
			$elements = split(",", $rhythmData[$i]);
			$time = (int)$elements[count($elements)-1];
			$key = "$elements[0]-p";
			//print "$key = $time\n";

			if($elements[1] === "p")
			{
				$status[$key] = $time;
				//print "$key = $status[$key]\n";
			}

			else
			{
				$pretime = $status[$key];
				$rhythm[] = $time - $pretime;
				print "$elements[0]: ($time - $pretime)\n";
			}

		}

		return $rhythm;
	}

	function getRhythm4SmartPhone($rhythmData)
	{
		$rhythm = array();
		$pretime = 0;
		$time = 0;

		for($i=0;$i<count($rhythmData);$i++)
		{
			$elements = split(",", $rhythmData[$i]);
			$time = (int)$elements[count($elements)-1];

			if($i > 0)
			{
				$rhythm[] = $time - $pretime;
				//print "($time - $pretime)\n";
			}

			$pretime = $time;
		}

		return $rhythm;
	}

	function getAveSd($rhythm)
	{
		$ave = 0.0;
		$sd = 0.0;

		for($i=0;$i<count($rhythm);$i++)
		{
			$ave += $rhythm[$i];
		}

		$ave /= (double)count($rhythm);

		for($i=0;$i<count($rhythm);$i++)
		{
			$sd += ($ave - $rhythm[$i]) * ($ave - $rhythm[$i]);
		}

		$sd = sqrt($sd / (double)count($rhythm));

		return array($ave, $sd);
	}

	function getRhythmModel($profiles, $userAgent)
	{
		$rhythm = array();

		for($i=0;$i<count($profiles);$i++)
		{ 
			$contents = readKeystrokeData($profiles[$i]);

			if($userAgent === "web")
			{
				$rhythm = array_merge($rhythm, getRhythm4PC($contents));
			}

			else
			{
				$rhythm = array_merge($rhythm, getRhythm4SmartPhone($contents));
			}
		}

		return getAveSd($rhythm);
	}

	function compareAveSd($testRhythm, $rhythmModel)
	{
		$testAve = $testRhythm[0];
		$testSd = $testRhythm[1];
		$profileAve = $rhythmModel[0];
		$profileSd = $rhythmModel[1];
		return array(($testAve / $profileAve), ($testSd / $profileSd));
	}

	function recognizeEmotion($profileDir, $testPath, $userId, $userAgent)
	{
		$profiles = listTargetFiles($profileDir, $userId);
		$rhythmModel = getRhythmModel($profiles, $userAgent);
		$testContents = readKeystrokeData($testPath);
		$inputDelRatio = getInputDelRatio($testContents, "BS");

		if($userAgent === "web")
		{
			$testRhythm = getRhythm4PC($contents);
		}

		else
		{
			$testRhythm = getRhythm4SmartPhone($testContents);
		}

		$aveSdRatio = compareAveSd(getAveSd($testRhythm), $rhythmModel);

		if($inputDelRatio >= 0.3)
		{
			return "confused.png";
		}

		else if($aveSdRatio[0] >= 1.5)
		{
			return "exhausted.png";
		}

		return "normal.png";
	}

	function recognizeUserEmotion($message)
	{
		$emotion = array(':w' => 'smile.png',
			':a' => 'angry.png',
			':c' => 'confused.png',
			':e' => 'exhausted.png',
			':n' => 'nice.png',
			':s' => 'smile.png',
			':b' => 'bitterlaugh.png');

		$suffix = substr($message, -2);

		if(isset($emotion[$suffix]))
		{
			return $emotion[$suffix];
		}

		return "normal.png";
	}
	//print recognizeEmotion("profile-iOS", "test/testid1-20150330-091633.csv", "testid1", "iOS");
?>
