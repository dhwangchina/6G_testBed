/*
 * sort_quick.cpp
 *
 *  Created on: 2021��11��9��
 *      Author: Administrator
 */
#include "sort_quick.hpp"

unsigned int sortQuick(unsigned int *vpulVal, unsigned short int vulBgnIndex, unsigned short int vulEndIndex)
{
	unsigned int ulLoopI = 0;
    unsigned int ulLoopJ = 0;

    if(NULL == vpulVal)
    {
    	printf("OOP. Input parameters Error.\n");
    	return 1;
    }

    ulLoopI    = vulBgnIndex;
    ulLoopJ    = vulEndIndex;
    vpulVal[0] = vpulVal[vulBgnIndex];

    while(ulLoopI < ulLoopJ)
    {
        while((ulLoopI<ulLoopJ) && (vpulVal[0] < vpulVal[ulLoopJ]))
        {
        	ulLoopJ--;
        }

        if(ulLoopI < ulLoopJ)
        {
        	vpulVal[ulLoopI] = vpulVal[ulLoopJ];
            ulLoopI++;
        }

        while((ulLoopI < ulLoopJ) && (vpulVal[ulLoopI] <= vpulVal[0]))
        {
        	ulLoopI++;
        }

        if(ulLoopI < ulLoopJ)
        {
        	vpulVal[ulLoopJ] = vpulVal[ulLoopI];
            ulLoopJ--;
        }
    }

    vpulVal[ulLoopI] = vpulVal[0];

    if (vulBgnIndex < ulLoopI)
    {
    	sortQuick(vpulVal, vulBgnIndex, ulLoopJ-1);
    }

    if (ulLoopI < vulEndIndex)
    {
    	sortQuick(vpulVal, ulLoopJ + 1, vulEndIndex);
    }

    return 0;
}

