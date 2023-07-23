/*
 * sort_Select.cpp
 *
 *  Created on: 2021Äê11ÔÂ9ÈÕ
 *      Author: Administrator
 */

#include "sort_Select.hpp"

unsigned int sortSelect(unsigned int *vulValIn, unsigned short vslNum, unsigned int *vulValOut)
{
	unsigned int ulloop0  = 0;
	unsigned int ulLoop1   = 0;
	unsigned int minIndex = 0;
	unsigned int ulTmp    = 0;

	for(ulloop0 = 0; ulloop0 < vslNum; ulloop0++)
	{
		minIndex = ulloop0;
		for(ulLoop1 = ulloop0 + 1; ulLoop1 < vslNum; ulLoop1++)
		{
			if(vulValIn[ulLoop1] < vulValIn[minIndex])
			{
				ulTmp              = vulValIn[ulLoop1];
				vulValIn[ulLoop1]  = vulValIn[minIndex];
				vulValIn[minIndex] = ulTmp;
				minIndex           = ulLoop1;
			}
		}
	}
	memcpy((char*)vulValOut, (char*)vulValIn, vslNum * sizeof(vulValIn));

	return 0;
}
