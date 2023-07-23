/*
 * reverseInt.cpp
 *
 *  Created on: 2021Äê11ÔÂ4ÈÕ
 *      Author: Administrator
 */
#include <stdio.h>
#include <math.h>

#include "reverseInt.hpp"

unsigned int reverseInt(unsigned int vulVal)
{
	unsigned int ulRetVal = 0;
	unsigned int ulIndex  = 0;
	unsigned int ulWidth  = 0;
	unsigned int ulVal    = vulVal;

	char intChar[10] = {'\0'};

	printf("Original Data:%d\n",ulVal);
	for(ulIndex = 0; ulIndex < 10; ulIndex++)
	{
		intChar[ulIndex] = ulVal % 10;
		ulVal = ulVal / 10;
		if(ulVal == 0)
		{
			ulWidth = ulIndex + 1;
			break;
		}
	}

	for(ulIndex = 0; ulIndex < ulWidth; ulIndex++)
	{
		ulRetVal += intChar[ulIndex] * (int)pow(10,ulWidth - 1 - ulIndex);
	}

	printf("reversed Data:%d\n",ulRetVal);
	return ulRetVal;
}


