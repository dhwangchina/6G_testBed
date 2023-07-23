/*
 * sort_Bubble.cpp
 *
 *  Created on: 2021Äê11ÔÂ9ÈÕ
 *      Author: Administrator
 */

#include "sort_Bubble.hpp"

unsigned int sortBubble(unsigned int *vulValIn, unsigned short vslNum, unsigned int *vulValOut)
{
	unsigned int *pulTmp = NULL;
	unsigned int ulTmp   = 0;
	unsigned int ulLoop  = 0;
	unsigned int ulIterN = 0;

	if(NULL == vulValIn || vslNum <= 0)
	{
		printf("OOP. Input Parameters error.\n");
		return 1;
	}

	pulTmp = vulValIn;
	for(ulIterN = 0; ulIterN < vslNum; ulIterN++)//Iteration
	{
		for(ulLoop = 0; ulLoop < vslNum - 1; ulLoop++)
		{
			if(pulTmp[ulLoop] > pulTmp[ulLoop+1])
			{
				ulTmp            = pulTmp[ulLoop];
			    pulTmp[ulLoop]   = pulTmp[ulLoop+1];
			    pulTmp[ulLoop+1] = ulTmp;
			}
		}
	}

	memcpy((char*)vulValOut,(char*)pulTmp,vslNum * sizeof(pulTmp));
	return 0;
}


